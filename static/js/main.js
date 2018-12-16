$(document).ready(function() {
    let itemsPerPage = 3;
    if(window.location.pathname === '/')
    {
        getPosts(itemsPerPage, 0);
    }

    function getPosts(count, offset){
        $.get('/api/posts', { 'count': count, 'offset': offset }, function(data){
            $('.posts').html('');
            if(data.errors.length === 0)
            {
                for(let post of data.data.results)
                {
                    $('.posts').append('<div class="col-lg-12">\n' +
                        '            <h2>'+ post.subject +'</h2>\n' +
                        '            <p>Автор: '+ post.author +'</p>'+
                        '            <p>'+ (post.message.length > 10 ? post.message.substr(0,10)+'...' : post.message) +'</p>\n' +
                        '            <p><a class="btn btn-secondary" href="/post/'+ post.id +'" role="button">Подробнее</a></p>\n' +
                        '        </div>')
                }
                $('#pagination').remove();
                $('.posts').parent().parent().append(simplePagination(data.data.count, count, offset));
            }
            else
            {
                $('.alert-success').show();
            }
        },'json');
    }

    $('.container').on('click', '.page-link', function(e){
        e.preventDefault();
        let pageNum = $(this).text();
        getPosts(itemsPerPage, (pageNum - 1 === 0? 0: (pageNum -1)*itemsPerPage ));
    });

    function simplePagination(all, count, offset)
    {
        let paginationHtml = '<nav id="pagination">\n' +
            '  <ul class="pagination pagination-lg">\n';
        let pages = Math.ceil(all/count);
        for(let i = 0; i < pages; i++)
        {
            paginationHtml+=
            '    <li class="page-item'+(i*count === offset?' disabled':'')+'">\n' +
            '      <a class="page-link" href="#" tabindex="-1">'+ (i+1) +'</a>\n' +
            '    </li>\n';
        }
        paginationHtml+='  </ul>\n' +
            '</nav>';
        return paginationHtml;
    }

    $('.add button').bind('click', function(e){
        e.preventDefault();
        $.post('/api/post/send', $('form.add').serialize(), function(data){
            $('.invalid-feedback').html('').hide();
            if(data.errors.length !== 0)
            {
                for(let fieldKey in data.errors)
                {
                    $('#'+fieldKey+'.form-control').parent().find('.invalid-feedback').html(data.errors[fieldKey]).show();
                }
            }
            else
            {
                $('.alert-success').show();
            }
        },'json');
    });

    $('.login button').bind('click', function(e){
        e.preventDefault();
        $.post('/api/login', $('form.login').serialize(), function(data){
            $('.invalid-feedback').html('').hide();
            if(data.errors.length !== 0)
            {
                for(let fieldKey in data.errors)
                {
                    $('#'+fieldKey+'.form-control').parent().find('.invalid-feedback').html(data.errors[fieldKey]).show();
                }
            }
            else
            {
                window.location.pathname = '/admin';
            }
        },'json');
    });

    $('#refreshCaptcha').bind('click' , function(e){
        e.preventDefault();
        $.get('/api/refreshCaptcha', {}, function(data){
            $('#captchaImage').attr('src', '/captcha/?'+ new Date().getTime());
        });
    });
});