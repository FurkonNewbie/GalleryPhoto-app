var segmentTerakhir = window.location.href.split("/").pop();

$.getJSON(window.location.origin + '/profil_other/getDataProfil/' + segmentTerakhir, function (res) {
    console.log(res);
    $('#username').html(res.dataUser.username);
    $('#bio').html(res.dataUser.bio);
    $('#profile').prop('src', '/profile/' + res.dataUser.profile);
    $('#followers').html(res.jumlahFollower[0].jmlfollower + ' Followers')
    $('#following').html(res.jumlahFollowing[0].jmlfollowing + ' Following')

    if (res.dataUserActive == res.dataUser.id) {
        $('#tombolfollow').html('');
    } else {
        if (res.dataFollow == null) {
            $('#tombolfollow').html('<button class="flex justify-start text-star    t hover:bg-green-100 rounded-sm px-2" onclick="ikuti(this, ' + res.dataUser.id + ')"> + follow </button>');
        } else {
            $('#tombolfollow').html('<button class="flex justify-start text-start hover:bg-green-100 rounded-sm px-2" onclick="ikuti(this, ' + res.dataUser.id + ')"> following </button>');
        }
    }
});

function ikuti(txt, id) {
    $.ajax({
        url: window.location.origin + '/comment/ikuti',
        type: "POST",
        dataType: "JSON",
        data: {
            idfollow: id,
            _token: $('input[name="_token"]').val(),
        },
        success: function (res) {
            location.reload();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('AJAX Error:', textStatus, errorThrown);
            alert('Gagal mengikuti pengguna. Silakan coba lagi.');
        }
    });
}


//menampilkan postingan user lain
var paginate = 1;
var dataIndex = [];
loadMoreData(paginate);

$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() == $(document).height()) {
        paginate++;
        loadMoreData(paginate);
    }
});

function loadMoreData(paginate) {
    $.ajax({
        url: window.location.origin + '/getdataprofilother/' + '?page=' + paginate,
        type: "GET",
        dataType: "JSON",
        data: {
            userId: segmentTerakhir
        },
        success: function (e) {
            console.log(e);

            if (Array.isArray(e.data.data)) {
                e.data.data.map((x) => {
                    var hasilPencarian = Array.isArray(x.like) ? x.like.filter(function (hasil) {
                        return hasil.user_id === e.userId;
                    }) : [];
                    if (hasilPencarian.length <= 0) {
                        userLike = 0;
                    } else {
                        userLike = hasilPencarian[0].user_id;
                    }
                    let datanya = {
                        id: x.id,
                        judul: x.judul_foto,
                        deskripsi: x.deskripsi,
                        foto: x.url,
                        tanggal: x.created_at,
                        jml_comment: x.comment_count,
                        jml_like: x.like_count,
                        username: x.user.username,
                        profile: x.user.profile,
                        idUserLike: userLike,
                        useractive: e.userId,
                    };
                    dataIndex.push(datanya);
                });
                getIndex(); // Remove this line
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('AJAX Error:', textStatus, errorThrown);
            alert('Gagal mengambil data profil. Silakan coba lagi.');
        }
    });
}

const getIndex = () => {
    $('#indexdata').html('')
    dataIndex.map((x, i) => {
        $('#indexdata').append(
            `
        <img src="/foto/${x.foto}" alt="" class="">`
        )
    })
}
