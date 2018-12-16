$(document).ready(function() {
    let itemsPerPage = 3;
    if(window.location.pathname === '/admin')
    {
        getPosts(itemsPerPage, 0);
    }

    function getPosts(count, offset){
        $.get('/api/posts/all', { 'count': count, 'offset': offset }, function(data){
            $('.posts').html('');
            if(data.errors.length === 0)
            {
                for(let post of data.data.results)
                {
                    $('.posts').append('<div class="col-lg-12" data-id="'+ post.id +'">\n' +
                        '            <h2>'+ post.subject +'</h2>\n' +
                        '            <p>Автор: '+ post.author +'</p>'+
                        '            <p>Email: '+ post.email +'</p>'+
                        '            <p>'+ post.message +'</p>\n' +
                        (post.published === 0 ?'            <p><a class="btn btn-success showHide" href="#" role="button">Опубликовать</a></p>\n': '            <p><a class="btn btn-secondary showHide" href="#" role="button">Скрыть</a></p>\n') +
                        '            <p><a class="btn btn-danger delete" href="#" role="button">Удалить</a></p>\n' +
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

    $('.container').on('click', '.showHide', function(e){
        e.preventDefault();
        let id = $(this).parent().parent().attr('data-id');
        $.get('/api/showHide/' + id, {}, function(data){
            getPosts(itemsPerPage, 0);
        },'json');
    });

    $('.container').on('click', '.delete', function(e){
        e.preventDefault();
        let id = $(this).parent().parent().attr('data-id');
        $.get('/api/delete/' + id, {}, function(data){
            getPosts(itemsPerPage, 0);
        },'json');
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

    $('.logout').bind('click', function(e){
        $.get('/api/logout', {}, function(data){
            window.location.pathname = '/';
        },'json');
    });
});