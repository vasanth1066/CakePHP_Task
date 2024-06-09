<?php $this->layout = 'UsersLayout'; ?>

<?= $this->Form->create(null, ['type' => 'get']); ?>
<div class="navbar">
<span class="navbar-brand">Books</span>
        <span class="navbar-brand"><?= $this->Html->link('To Add Books ', ['controller' => 'Books', 'action' => 'index']) ?></span>
        <button class="logout-button"><?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout']) ?></button>
</div>
<div  class="sidebar">
    <div  class="authors">
        <h2>Authors</h2>
        <?php foreach ($authors as $author): ?>
            <label><input type="checkbox" class="author-checkbox" value="<?= $author->id ?>"> <?= h($author->first_name) ?></label><br>
        <?php endforeach; ?>
    </div>

    <div class="publishers">
        <h2>Publishers</h2>
        <?php foreach ($publishers as $publisher): ?>
            <label><input type="checkbox" class="publisher-checkbox" value="<?= $publisher->id ?>"> <?= h($publisher->name) ?></label><br>
        <?php endforeach; ?>
    </div>
    <div class="orders">
    <button class="home-button"><?= $this->Html->link('View Orders', ['controller' => 'Orders', 'action' => 'index']) ?></button>
        
    </div>
</div>

<!-- search input field -->
<div class="main-content">
    <div class="search">
        <h2>Search Books</h2>
        <input type="text" id="search-query" placeholder="Search Book here">
        <button id="search-button">Search</button>
    </div>

    <div id="book-results">
        <!-- books will add here -->
        <h3>Books</h3>
        <ul ></ul>
        <div id="book-list"></div>

    </div>

    <div id="no-books-found"style="display: none;">
        <h5>No books found</h5>
    </div>

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
                    var listItem = $('<div class="card"></div>');
                    var likeButton = $('<button class="like-button" data-book-id="' + book.id + '">Like</button>');
                    var bookDetailsLink = $('<a href="<?= $this->Url->build(['controller' => 'Books', 'action' => 'display']); ?>/' + book.id + '">View Details</a>');
                    var addToCartLink = $('<a href="<?= $this->Url->build(['controller' => 'Books', 'action' => 'addToCart']); ?>/' + book.id + '"> Add to Cart</a>');
                    
                    listItem.append('<h4>' + book.title + '</h4>');
                    listItem.append('<p>Price: Rs ' + book.price + '</p>');
                    listItem.append('<p>Author: ' + book.author.first_name + '</p>');
                    listItem.append('<p>Publisher: ' + book.publisher.name + '</p>');
                    listItem.append('<p>Views: ' + book.like_count + '</p>');
                    listItem.append(likeButton);
                    listItem.append(bookDetailsLink);
                    listItem.append(addToCartLink);
                    $('#book-list').append(listItem);

                    likeButton.on('click', function(e) {
                        e.preventDefault();
                        var bookId = $(this).data('book-id');
                        // console.log('bookId',bookId)
                        var updateCountUrl = '<?= $this->Url->build(['controller' => 'Books', 'action' => 'updateCount']); ?>' + '?bookId=' + bookId;
                        // console.log('updateCountUrl',updateCountUrl)
                        // redirect to the updateCount URL
                        window.location.href = updateCountUrl;
        
                    });
                });
            } else {
                noBooksFound.show();
            }
        }

        // fetch all books initially
        fetchBooksByFilters();
    });
</script>
