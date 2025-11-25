document.addEventListener('DOMContentLoaded', function () {
    const destinationContainer = document.getElementById('destination-container');
    const paginationContainer = document.querySelector('.pagination');

    const urlParams = new URLSearchParams(window.location.search);
    let currentPage = parseInt(urlParams.get('page')) || 1;
    const itemsPerPage = parseInt(urlParams.get('limit')) || 9;
    const searchQuery = urlParams.get('search') || '';
    document.getElementById('form-search').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting
    });


    const notFound = `
    <div class="flex justify-center items-center min-h-[30px]">
        <div class="text-center">
            <img src="${baseUrl}assets/images/search-not-found.svg" alt="">

            <h4 class="mt-3">Tidak ada Destinasi<br>yang sesuai</h4>

            <button class="bg-green-500 text-white mt-3 py-2 px-4 rounded">
                <a href="${baseUrl}" class="no-underline text-white">Reset Pencarian</a>
            </button>
        </div>
    </div>
    `;


    function fetchDestination(page = 1, search = '') {
        // Get selected categories
        const selectedCategories = [];
        document.querySelectorAll('#categories-checkboxes input:checked').forEach(checkbox => {
            selectedCategories.push(checkbox.getAttribute('data-id'));
        });

        // Get selected provinces
        const selectedProvinces = [];
        document.querySelectorAll('#provinces-checkboxes input:checked').forEach(checkbox => {
            console.log(checkbox.nextElementSibling.textContent);
            selectedProvinces.push(checkbox.nextElementSibling.textContent);
        });

        injectLoader('destination-container');
        let url = `api/destinations?page=${page}&limit=${itemsPerPage}&search=${search}&categories=${encodeURIComponent(selectedCategories.join(','))}&provinces=${encodeURIComponent(selectedProvinces.join(','))}`;
        console.log(baseUrl + url)
        fetch(url)
            .then(res => {
                let data = {}
                // Check if response is JSON
                try {
                    data = res.json();
                } catch (error) {
                    renderPageToNewTab(res.text());  // Render in new tab and break the chain
                    throw error;
                }

                return data;
            })
            .then(data => {
                removeLoader('destination-container');
                updatePagination(data.current_page, data.total_pages);
                updateDestination(data.destination);
            })
            .catch(error => console.error('Error fetching destination:', error));
    }


    function updateDestination(destination) {
        destinationContainer.innerHTML = '';

        const filledStar = `
        <svg width="15" height="14" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.1304 0L12.4293 7.07548H19.8689L13.8501 11.4484L16.1491 18.5238L10.1304 14.151L4.11159 18.5238L6.41055 11.4484L0.391793 7.07548H7.83139L10.1304 0Z" fill="#FFC100"/>
        </svg>`;

        const unfilledStar = `
        <svg width="15" height="14" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9.76121 0L12.0602 7.07548H19.4998L13.481 11.4484L15.78 18.5238L9.76121 14.151L3.74245 18.5238L6.04141 11.4484L0.0226526 7.07548H7.46225L9.76121 0Z" fill="#D9D9D9"/>
        </svg>
        `;

        if (destination.lenght < 1){
            console.log(notFound);
            destinationContainer.insertAdjacentHTML('beforeend', notFound);
        }

        destination.forEach(dest => {
            console.log(dest);
            // Create star rating HTML
            let starRatingHTML = '';
            const fullStars = Math.floor(dest.avg_rating);
            const halfStar = dest.avg_rating % 1 !== 0;
            const emptyStars = 5 - fullStars - (halfStar ? 1 : 0);

            for (let i = 0; i < fullStars; i++) {
                starRatingHTML += filledStar;
            }
            if (halfStar) {
                starRatingHTML += `<svg width="15" height="14" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.1304 0L12.4293 7.07548H19.8689L13.8501 11.4484L16.1491 18.5238L10.1304 14.151L4.11159 18.5238L6.41055 11.4484L0.391793 7.07548H7.83139L10.1304 0Z" fill="#FFC100" style="clip-path: inset(0 50% 0 0);"/>
                </svg>`;
            }

            for (let i = 0; i < emptyStars; i++) {
                starRatingHTML += unfilledStar;
            }
            // Handle image path - add baseUrl if it's a relative path
            if (dest.image.startsWith('/storage/')) {
                dest.image = baseUrl + dest.image.substring(1);  // Remove leading slash and add baseUrl
            } else if (!dest.image.startsWith('http')) {
                dest.image = baseUrl + dest.image;
            }

            // Create the destination HTML
            const destinationHTML = `
        <div class="destination-card-container ">
            <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col transform transition-transform duration-300 hover:-translate-y-2 hover:shadow-lg" style="min-height: 403px; width: 284px;">
                <a href="${baseUrl}tempat-wisata/${dest.id}" class="no-underline text-black flex flex-col flex-1">
                    <div class="relative" style="width: 284px; height: 198px;">
                        <img src="${dest.image}" class="w-full h-full object-cover" alt="${dest.name}">
                    </div>
                    <!-- Main Content -->
                    <div class="p-4 flex-grow">
                        <!-- Destination Name -->
                        <h3 class="text-2xl mb-1 text-[#656565]">${dest.name}</h3>
                    </div>
                    <!-- Footer with Star Rating, Location, and Price -->
                    <div class="p-4 mt-auto">
                        <!-- Star Rating -->
                        <div class="flex mb-2 pt-3">
                            ${starRatingHTML}
                        </div>

                        <!-- Location (wrapped text) -->
                        <div class="flex text-sm text-gray-700 mb-2">
                            <img src="${baseUrl}assets/images/icons/location.svg" alt="" class="w-4 h-4 mb-auto mr-2">
                            <span class="text-gray-700 break-words">
                                ${dest.address}
                            </span>
                        </div>

                        <!-- Price (always at bottom, aligned across cards) -->
                        <div class="text-xl font-bold text-[#00CCDD] flex">
                            <img src="${baseUrl}assets/images/icons/tickets.svg" alt="" class="w-7 h-7 mr-2">
                            <span class="text-cyan-500">
                                Rp ${formatPriceValue(removeTrailingZeros(dest.price.toFixed(2)))}
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        </div>


            `;

            // Insert the destination HTML into the container
            destinationContainer.insertAdjacentHTML('beforeend', destinationHTML);
        });


    }

    function updatePagination(currentPage, totalPages) {
        paginationContainer.innerHTML = '';

        const prevPage = currentPage > 1 ? currentPage - 1 : null;
        if (prevPage) {
            paginationContainer.insertAdjacentHTML('beforeend', `
                <li class="page-item">
                    <a class="page-link px-4 py-2 border rounded-md text-cyan-500 bg-white hover:bg-cyan-100 cursor-pointer" href="#" onclick="changePage(${prevPage})">&lt;</a>
                </li>
            `);
        } else {
            paginationContainer.insertAdjacentHTML('beforeend', `
                <li class="page-item disabled">
                    <a class="page-link px-4 py-2 border rounded-md text-cyan-500 bg-white cursor-not-allowed">&lt;</a>
                </li>
            `);
        }

        for (let i = 1; i <= totalPages; i++) {
            const activeClass = i === currentPage ? ' bg-cyan-500 text-white' : ' text-cyan-500 hover:bg-cyan-100';
            paginationContainer.insertAdjacentHTML('beforeend', `
                <li class="page-item">
                    <a class="page-link px-4 py-2 border rounded-md${activeClass} cursor-pointer" href="#" onclick="changePage(${i})">${i}</a>
                </li>
            `);
        }

        const nextPage = currentPage < totalPages ? currentPage + 1 : null;
        if (nextPage) {
            paginationContainer.insertAdjacentHTML('beforeend', `
                <li class="page-item">
                    <a class="page-link px-4 py-2 border rounded-md text-cyan-500 bg-white hover:bg-cyan-100 cursor-pointer" href="#" onclick="changePage(${nextPage})">&gt;</a>
                </li>
            `);
        } else {
            paginationContainer.insertAdjacentHTML('beforeend', `
                <li class="page-item disabled">
                    <a class="page-link px-4 py-2 border rounded-md text-cyan-500 bg-white cursor-not-allowed">&gt;</a>
                </li>
            `);
        }
    }

    window.changePage = function(page) {
        currentPage = page;
        const newUrl = new URL(window.location.href);
        newUrl.searchParams.set('page', page);
        window.history.pushState({}, '', newUrl);
        fetchDestination(page, searchQuery);
    }

    document.querySelectorAll(".search-btn").forEach((element) => {
        element.addEventListener('click', function() {
            let query = document.getElementById("search-input").value;
            fetchDestination(currentPage, query);
        });
    });
    


    // Initial fetch
    fetchDestination(currentPage, searchQuery);
});
