<?php $this->layout = 'UsersLayout'; ?>

<?= $this->Form->create(null, ['type' => 'get']); ?>
<div class="row">
    <div class="col-md-6">
        <h2>Authors</h2>
        <?php foreach ($authors as $author): ?>
            <label><input type="checkbox" class="author-checkbox" value="<?= $author->id ?>"> <?= h($author->first_name) ?></label><br>
        <?php endforeach; ?>
    </div>

    <div class="col-md-6">
        <h2>Publishers</h2>
        <?php foreach ($publishers as $publisher): ?>
            <label><input type="checkbox" class="publisher-checkbox" value="<?= $publisher->id ?>"> <?= h($publisher->name) ?></label><br>
        <?php endforeach; ?>
    </div>
</div>

<!-- search input field -->
<div class="col-md-6">
    <h2>Search Books</h2>
    <input type="text" id="search-query" placeholder="Search Book here">
    <button id="search-button">Search</button>
</div>

<div id="book-results" class="col-md-12">
    <!-- books will add here -->
    <h3>Books</h3>
    <ul id="book-list"></ul>
</div>


<div id="no-books-found" class="col-md-12" style="display: none;">
    <h5>No books found</h5>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // fetch books on selected authors and publishers
        function fetchBooksByFilters() {
            var authorIds = $('.author-checkbox:checked').map(function () {
                return $(this).val();
            }).get();

            var publisherIds = $('.publisher-checkbox:checked').map(function () {
                return $(this).val();
            }).get();

            var url = '<?= $this->Url->build(['controller' => 'Books', 'action' => 'fetchBooksByFilters']); ?>';
            url += '?authors=' + encodeURIComponent(authorIds.join(',')) + '&publishers=' + encodeURIComponent(publisherIds.join(','));

            $.getJSON(url)
            .done(function (response) {
                displayBooks(response);
            })
            .fail(function (xhr, status, error) {
                console.log(error);
            });
        }

        // event listener checkboxes
        $('.author-checkbox, .publisher-checkbox').on('change', function () {
            fetchBooksByFilters();
        });

        // event listener search
        $('#search-button').on('click', function (e) {
            e.preventDefault();
            var searchQuery = $('#search-query').val();
            fetchBooksBySearch(searchQuery);
        });

        $('#search-query').on('input', function () {
            var searchQuery = $(this).val();
            // console.log('searchQuery',searchQuery)
            fetchBooksBySearch(searchQuery);
        });


        //fetch books search
        function fetchBooksBySearch(searchQuery) {

            var url = '<?= $this->Url->build(['controller' => 'Books', 'action' => 'fetchBooksBySearch']); ?>';
            url += '?search=' + encodeURIComponent(searchQuery);
            // console.log('url',url)
            // console.log('fetchBooksBySearch searchQuery',searchQuery)

            $.getJSON(url)
            .done(function (response) {
                // console.log('-------------response-------------',response);
                displayBooks(response);
            })
            .fail(function (xhr, status, error) {
                console.log(error);
            });
        }

        function displayBooks(books) {
            var bookList = $('#book-list');
            var noBooksFound = $('#no-books-found');

            bookList.empty();
            noBooksFound.hide(); 

            if (Array.isArray(books) && books.length > 0) {
                books.forEach(function (book) {
                    var listItem = $('<li></li>').text(book.title + ' - ' + book.author.first_name + ' - ' + book.publisher.name);
                    bookList.append(listItem);
                });
            } else {
                noBooksFound.show();
            }
        }

        // fetch all books initially
        fetchBooksByFilters();
    });
</script>
