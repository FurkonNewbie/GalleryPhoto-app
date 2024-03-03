var segmentTerakhir = window.location.href.split('/').pop();

$.ajax({
    url: window.location.origin + '/comment/' + segmentTerakhir + '/getdatadetail',
    type: "GET",
    dataType: "JSON",
    success: function (res) {
        console.log(res)
        $('#fotodetail').prop('src', '/foto/' + res.dataDetailFoto.url)
        $('#profile').prop('src', '/profile/' + res.dataDetailFoto.user.profile)
        $('#username').html(res.dataDetailFoto.user.username)
        $('#username').prop('href', '/profil_other/' + res.dataDetailFoto.user.id)
        let createdDateUTC = new Date(res.dataDetailFoto.user.created_at);
        let offset = new Date().getTimezoneOffset();
        let createdDateLocal = new Date(createdDateUTC.getTime() - (offset * 60 * 1000));

        let hours = createdDateLocal.getHours();
        let minutes = createdDateLocal.getMinutes();
        let ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12 || 12;

        let formattedDate = `${hours}:${minutes < 10 ? '0' : ''}${minutes} ${ampm}, ${createdDateLocal.getDate()} ${getMonthName(createdDateLocal.getMonth())} ${createdDateLocal.getFullYear()}`;

        function getMonthName(monthIndex) {
            const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            return monthNames[monthIndex];
        }

        // Update HTML element dengan tanggal yang diformat
        $('#tanggal').html(formattedDate);
        $('#deskripsi').html(res.dataDetailFoto.deskripsi)
        ambilKomentar()
        var idUser;
        if (res.dataFollow == null) {
            idUser = ""
        } else {
            idUser = res.dataFollow.user_id
        }

        if (res.dataDetailFoto.user_id === res.dataUser) {
            $('#tombolfollow').html('')
        } else {
            if (idUser == res.dataUser) {
                $('#tombolfollow').html(' <button class="hover:bg-green-100 rounded-sm px-2" onclick="ikuti(this,' + res.dataDetailFoto.user_id + ')"> mengikuti </button> ')
            } else {
                $('#tombolfollow').html(' <button class="hover:bg-green-100 rounded-sm px-2" onclick="ikuti(this,' + res.dataDetailFoto.user_id + ')"> + ikuti </button> ')

            }
        }
    },
    error: function (jqXHR, textStatus, errorThrown) {
        alert('gagal')
    }
})

function ambilKomentar() {
    $.getJSON(window.location.origin + '/comment/getComment/' + segmentTerakhir, function (res) {
        // console.log(res)
        if (res.data.length === 0) {
            $('#listkomentar').html('<div>komentar masih kosong</div>')
        } else {
            comment = []
            res.data.map((x) => {
                let createdDate = new Date(x.created_at);
                let formattedDate = `${createdDate.getHours()}:${createdDate.getMinutes()}, ${createdDate.getDate()} ${getMonthName(createdDate.getMonth())}, ${createdDate.getFullYear()}`;
                let datacomentar = {
                    idUser: x.user.id,
                    user_id: x.user_id,
                    pengirim: x.user.username,
                    waktu: formattedDate,
                    isikomentar: x.isi_komentar,
                    fotopengirim: x.user.profile
                }
                comment.push(datacomentar);
            })
            tampilkankomentar()
        }
    })
}

const tampilkankomentar = () => {
    $('#listkomentar').html('')
    comment.map((x, i) => {
        $('#listkomentar').append(`    <div class="flex mb-3">
        <a href="/profil_other/${x.user_id}">
        <img src="/profile/${x.fotopengirim}" class="w-10 h-10" alt="" />
        <div class="flex flex-col">
            <h3 class="text-md mx-2">${x.pengirim}</h3>
            </a>
            <h5 class="text-xs mx-2">
                ${x.isikomentar}
            </h5>
        </div>
    </div>`)
    })
}



function kirimkomentar() {
    $.ajax({
        url: window.location.origin + '/comment/kirimkomentar',
        type: "POST",
        dataType: "JSON",
        data: {
            _token: $('input[name="_token"]').val(),
            idfoto: segmentTerakhir,
            isi_komentar: $('input[name="isi_komentar"]').val()
        },
        success: function (res) {
            $('input[name="isi_komentar"]').val('')
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('gagal mengirim komentar')
        }
    })
}

setInterval(ambilKomentar, 500);


function ikuti(txt, idfollow) {
    $.ajax({
        url: window.location.origin + '/comment/ikuti',
        type: "POST",
        dataType: "JSON",
        data: {
            idfollow: idfollow,
            _token: $('input[name="_token"]').val(),
        },
        success: function (res) {
            location.reload()
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('gagal')
        }
    })
}

// Function to get the month name
function getMonthName(monthIndex) {
    const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    return monthNames[monthIndex];
}
