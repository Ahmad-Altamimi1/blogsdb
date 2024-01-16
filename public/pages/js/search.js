    document.addEventListener('DOMContentLoaded', function() {

    // document.querySelector(".preloader").style.display = "none";
        var searchInput = document.getElementById('searchInput');
        var searchResults = document.getElementById('searchResults');

        searchInput.addEventListener('input', function() {
            var query = searchInput.value;
    var searchResultItems = document.querySelectorAll('#searchResults');

            searchResultItems.forEach(function (searchResultItem) {
        searchResultItem.style.display = "block";
    });
            var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/search', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var results = JSON.parse(xhr.responseText);
                    displayResults(results);
                }
            };
            xhr.send('query=' + encodeURIComponent(query));

        if (searchInput.value=="") {
            searchResults.style.height=0;
        }
    console.log("yuddp");

    function displayResults(results) {
    searchResults.innerHTML = '';
    console.log("yup222");
    // console.log(document.querySelector('#searchcontent'));
        if (results.length > 0) {
        var containerHeight = results.length > 0 ? results.length * 70 : 100;
        searchResults.style.height = containerHeight + 'px';

        results.forEach(function(result, index) {
        var searchResultsul = document.querySelector('#searchResults');

        searchResultsul.style.display = 'flex';
        searchResultsul.style.flexDirection = 'column';

        var li = document.createElement('li');
        li.style.listStyle = "none";

        li.innerHTML = `<a style="color:white;" href="posts/${result.id}/show">
--${result.TITLE}</a>`;
        searchResults.appendChild(li);
    });

        } else {
            var li = document.createElement('li');
        li.style.listStyle = "none";

            li.textContent = 'لا يوجد نتائج ';

            searchResults.style.height = '50px';

            searchResults.appendChild(li);
        }

    }
    });
});
// document.addEventListener('click', function () {
//     var searchResultItems = document.querySelectorAll('#searchResults');
// console.log('searchResultItems',searchResultItems);
//     searchResultItems.forEach(function (searchResultItem) {
//         searchResultItem.style.display = "none";
//     });
// });
