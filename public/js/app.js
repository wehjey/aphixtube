let keyword;

$(document).ready(function () {
    keyword = 'aphix erp'
    let url = baseUrl + "/search?query=" + keyword

    loadVideos(url)
})

$("#submitBtn").click(function (e) {
    e.preventDefault()

    keyword = $('#inputSearch').val()
    let url = baseUrl + "/search?query=" + keyword

    loadVideos(url)
});

function loadVideos(url) {
    $.get(url, function (data, status) {

        $('#alert').addClass('d-none')

        if (data.success && data.data) {

            enablePagination(data.data)

            let results = data.data.items

            if (results) {
                $('#videoContainer').html('') // Clear out previous items
                results.forEach(buildItems)
            }

        } else {
            $('#alert').removeClass('d-none')
        }

    });
}

$(".page-link").on("click", function () {

    var token = $(this).attr("data-token");

    if (token == '#') {
        return;
    }

    let url = baseUrl + "/search?query=" + keyword + "&pageToken=" + token

    loadVideos(url)
});

function enablePagination(data) {

    if (data.nextPageToken !== undefined) {
        $('#nextPage').attr('data-token', data.nextPageToken)
    }

    if (data.prevPageToken !== undefined) {
        $('#prevPage').attr('data-token', data.prevPageToken)
    }

}

// Build html to show youtube search listing
function buildItems(item, index) {

    if (item.id.kind == 'youtube#channel') {
        $('#videoContainer').append(
            '<div class="col-3 mb-3">' +
            '<div class="card">' +
            '<img src="' + item.snippet.thumbnails.medium.url + '" class="card-img-top" alt="...">' +
            '<div class="card-body">' +
            '<h5 class="card-title">' + item.snippet.title + '</h5>' +
            '<a href="https://www.youtube.com/channel/' + item.id.channelId + '" target="_blank" class="btn btn-outline-danger btn-block">View Channel</a>' +
            '</div>' +
            '</div>' +
            '</div>'
        )
    } else {
        $('#videoContainer').append(
            '<div class="col-3 mb-3">' +
            '<div class="card">' +
            '<img src="' + item.snippet.thumbnails.medium.url + '" class="card-img-top" alt="...">' +
            '<div class="card-body">' +
            '<h5 class="card-title">' + item.snippet.title + '</h5>' +
            '<a href="https://www.youtube.com/watch?v=' + item.id.videoId + '" target="_blank" class="btn btn-outline-danger btn-block">Play Video</a>' +
            '</div>' +
            '</div>' +
            '</div>'
        )
    }


}