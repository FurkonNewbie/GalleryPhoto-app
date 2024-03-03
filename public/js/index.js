
// Initialize variables
var paginate = 1;
var dataIndex = [];

// Load more data on initial page load
loadMoreData(paginate);

// Load more data when scrolling to the bottom of the page
$(window).scroll(function () {
    if ($(window).scrollTop() >= $(document).height() - $(window).height() - 50) {
        paginate++;
        loadMoreData(paginate);
    }
});

// Function to handle the loading of more data
function loadMoreData(paginate) {
    $.ajax({
        url: window.location.origin + '/getDataIndex' + '?page=' + paginate,
        type: "GET",
        dataType: "JSON",
        success: function (e) {
            console.log(e);

            e.data.data.forEach((x) => {
                var hasilPencarian = x.like.filter(function (hasil) {
                    return hasil.user_id === e.userId;
                });

                var userLike = hasilPencarian.length > 0 ? hasilPencarian[0].user_id : 0;
                let createdDate = new Date(x.created_at);
                let formattedDate = `${createdDate.getHours()}:${createdDate.getMinutes()}, ${createdDate.getDate()} ${getMonthName(createdDate.getMonth())}, ${createdDate.getFullYear()}`;

                let datanya = {
                    id: x.id,
                    user_id: x.user_id,
                    judul: x.judul_foto,
                    deskripsi: x.deskripsi,
                    foto: x.url,
                    tanggal: formattedDate,
                    jml_comment: x.comment_count,
                    jml_like: x.like_count,
                    username: x.user.username,
                    profile: x.user.profile,
                    idUserLike: userLike,
                    useractive: e.userId,
                    isOwner: (x.user_id === e.userId),
                };

                dataIndex.push(datanya);
            });

            // Display the data based on search input
            handleSearch();
            updateFollowButton(e.dataFollow, e.dataDetailFoto);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // Handle error
        },
    });
}

// Function to display the index data
const getIndex = () => {
    $('#indexdata').html('');
    dataIndex.forEach((x, i) => {
        let imageUrl = `/foto/${x.foto}`;

        // Periksa apakah postingan dimiliki oleh pengguna saat ini
        const isOwnPost = x.isOwner; // Mengasumsikan 'isOwner' adalah properti yang menunjukkan apakah postingan dimiliki oleh pengguna saat ini

        // Tampilkan tombol "Laporkan" hanya untuk postingan yang dibuat oleh pengguna lain
        const reportButtonHtml = isOwnPost ? '' : `
            <div class="flex justify-end mr-2 my-1">
                <a class="report-button block focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 text-center"
                    data-modal-target="default-modal" data-modal-toggle="default-modal"
                    href="/report_foto/${x.id}">
                    laporkan
                </a>
            </div>
        `;

        $('#indexdata').append(`
            <div class="bg-white shadow-xl rounded-lg w-full h-auto lg:w-[550px] ">
                <!-- Bagian Dropdown -->
                <div class="flex justify-end mr-2 my-1">
                ${reportButtonHtml}
                </div>

                <hr class="mx-auto w-11/12 border-t border-gray-300">
                <div class="flex pr-4 pl-4 pt-2 justify-between">
                    <div class="flex">
                        <a href="/profil_other/${x.user_id}">
                            <img src="/profile/${x.profile}" class="w-8 h-8 rounded-full" alt="">
                        </a>
                        <div class="flex flex-col ml-2">
                            <a href="/profil_other/${x.user_id}">
                                <h3 class="text-sm">${x.username}</h3>
                            </a>
                            <h6 class="text-xs">${x.tanggal}</h6>
                        </div>
                    </div>
                    <div id="tombolfollow">
                        <button class="hover:bg-green-100 rounded-sm px-2">+ follow</button>
                    </div>
                </div>
                <div class="text-xs px-4 pt-2 mb-2">${x.deskripsi}</div>
                <div class="overflow-hidden flex justify-center mb-2">
                    <img src="${imageUrl}" alt="" class="">
                </div>
                <div class="flex justify-between">
                    <div class="text-xs ml-4 my-2">
                        <i class="fa-solid fa-thumbs-up text-blue-800"></i> ${x.jml_like} like
                    </div>
                    <div class="text-xs mr-4 my-2">
                        <p></p>${x.jml_comment} comment
                    </div>
                </div>
                <hr class="mx-auto w-11/12 border-t border-gray-300">
                <div class="mx-auto flex justify-evenly items-center text-center mb-5">
                    <div>
                        <button onclick="like(this,${x.id})" class="flex justify-center items-center w-full bg-white hover:bg-slate-200 text-xs rounded-md px-5 text-center me-2 mt-4 h-10">
                            <i class="${x.idUserLike === x.useractive ? 'fa-solid fa-thumbs-up text-blue-800' : 'fa-regular fa-thumbs-up'} fa-regular fa-thumbs-up mr-2"></i> like
                        </button>
                    </div>
                    <div>
                        <a href="/comment/${x.id}" class="flex justify-center items-center w-full bg-white hover:bg-slate-200 text-xs rounded-md px-5 text-center me-2 mt-4 h-10">
                            <i class="fa-regular fa-comment mr-2"></i>komen
                        </a>
                    </div>
                </div>
            </div>
        `);
    });
    handleSearch(); // Display data based on search input
}

// Function to filter data based on search input
const filterData = (searchTerm) => {
    return dataIndex.filter((x) => x.deskripsi.toLowerCase().includes(searchTerm.toLowerCase()));
}

// Function to handle search
const handleSearch = () => {
    const searchInput = document.getElementById('search-dropdown');
    const searchTerm = searchInput.value;

    // Filter the data based on the search term
    const filteredData = filterData(searchTerm);

    // Clear existing data in the '#indexdata' element
    $('#indexdata').html('');

    // Display the filtered data
    filteredData.forEach((x, i) => {
        let imageUrl = `/foto/${x.foto}`;

        // Periksa apakah postingan dimiliki oleh pengguna saat ini
        const isOwnPost = x.isOwner; // Mengasumsikan 'isOwner' adalah properti yang menunjukkan apakah postingan dimiliki oleh pengguna saat ini

        // Tampilkan tombol "Laporkan" hanya untuk postingan yang dibuat oleh pengguna lain
        const reportButtonHtml = isOwnPost ? '' : `
            <div class="flex justify-end mr-2 my-1">
                <a class="report-button block focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 text-center"
                    data-modal-target="default-modal" data-modal-toggle="default-modal"
                    href="/report_foto/${x.id}">
                    laporkan
                </a>
            </div>
        `;

        $('#indexdata').append(`
            <div class="bg-white shadow-xl rounded-lg w-full h-auto lg:w-[550px] ">
                <!-- Bagian Dropdown -->
                <div class="flex justify-end mr-2 my-1">
                ${reportButtonHtml}
                </div>

                <hr class="mx-auto w-11/12 border-t border-gray-300">
                <div class="flex pr-4 pl-4 pt-2 justify-between">
                    <div class="flex">
                        <a href="/profil_other/${x.user_id}">
                            <img src="/profile/${x.profile}" class="w-8 h-8 rounded-full" alt="">
                        </a>
                        <div class="flex flex-col ml-2">
                            <a href="/profil_other/${x.user_id}">
                                <h3 class="text-sm">${x.username}</h3>
                            </a>
                            <h6 class="text-xs">${x.tanggal}</h6>
                        </div>
                    </div>
                    <div id="tombolfollow">
                        <button class="hover:bg-green-100 rounded-sm px-2">+ follow</button>
                    </div>
                </div>
                <div class="text-xs px-4 pt-2 mb-2">${x.deskripsi}</div>
                <div class="overflow-hidden flex justify-center mb-2">
                    <img src="${imageUrl}" alt="" class="">
                </div>
                <div class="flex justify-between">
                    <div class="text-xs ml-4 my-2">
                        <i class="fa-solid fa-thumbs-up text-blue-800"></i> ${x.jml_like} like
                    </div>
                    <div class="text-xs mr-4 my-2">
                        <p></p>${x.jml_comment} comment
                    </div>
                </div>
                <hr class="mx-auto w-11/12 border-t border-gray-300">
                <div class="mx-auto flex justify-evenly items-center text-center mb-5">
                    <div>
                        <button onclick="like(this,${x.id})" class="flex justify-center items-center w-full bg-white hover:bg-slate-200 text-xs rounded-md px-5 text-center me-2 mt-4 h-10">
                            <i class="${x.idUserLike === x.useractive ? 'fa-solid fa-thumbs-up text-blue-800' : 'fa-regular fa-thumbs-up'} fa-regular fa-thumbs-up mr-2"></i> like
                        </button>
                    </div>
                    <div>
                        <a href="/comment/${x.id}" class="flex justify-center items-center w-full bg-white hover:bg-slate-200 text-xs rounded-md px-5 text-center me-2 mt-4 h-10">
                            <i class="fa-regular fa-comment mr-2"></i>komen
                        </a>
                    </div>
                </div>
            </div>
        `);
    });
}

// Function to handle the like action
function like(txt, id) {
    $.ajax({
        url: window.location.origin + '/like',
        dataType: "JSON",
        type: "POST",
        data: {
            fotoid: id,
            _token: $('input[name="_token"]').val(),
        },
        success: function (res) {
            console.log(res);
            // Reload the page after successful like
            location.reload();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('gagal');
        }
    });
}

// Function to handle the follow action
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
            location.reload();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('gagal');
        }
    });
}

// Function to get the month name
function getMonthName(monthIndex) {
    const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    return monthNames[monthIndex];
}

// Handle search on input change
const searchInput = document.getElementById('search-dropdown');
searchInput.addEventListener('input', handleSearch);
