<?php $router = new \Slim\Slim();
// Models
$News = new News;

header('Content-type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");

/*-----------------------------------------------------------------------------------------------
*	Routes start here
-------------------------------------------------------------------------------------------------*/

// $router->get('/:id', function ($id) { ...	});
// $router->post('/', function () use ($router) { $router->request()->params('paramName'); });

/*------------------------------Audio-----------------------------*/

/*
*   http://test.oneway.vn/api/api-v3/index.php
*/
$router->get('/', function () { echo "<h1>Hello Oneway News API!</h1>"; });



/*------------------------------Tin Tuc-------------------------------*/

/*
*   http://test.oneway.vn/api/index.php/category-news
*/
$router->get('/category-news', function () use ($News) {
    json( $News->category() );
});
/*
*   http://test.oneway.vn/api/index.php/category-news/:id|slug
*/
$router->get('/category-news/:id', function ($id) use ($News) {
    json( $News->category($id) );
});


/*
*   http://test.oneway.vn/api/api-v3/index.php/news/:from[/:limit/:sort]
*/
$router->get('/news/:from', function ($from) use ($News) {
    json( $News->listNews($from) );
});
$router->get('/news/:from/:limit', function ($from,$limit) use ($News) {
    json ($News->listNews($from,$limit));
});
$router->get('/news/:from/:limit/:sort', function ($from, $limit, $sort) use ($News) {
    json ($News->listNews($from,$limit,$sort));
});


/*
*   http://test.oneway.vn/api/api-v3/index.php/news-category/:slug|id/:from[/:limit/:sort]
*/
$router->get('/news-category/:id/:from', function ($id,$from) use ($News) {
    json ($News->listNewsCate($id,$from));
});
$router->get('/news-category/:id/:from/:limit', function ($id,$from,$limit) use ($News) {
    json ($News->listNewsCate($id,$from,$limit));
});
$router->get('/news-category/:id/:from/:limit/:sort', function ($id,$from, $limit, $sort) use ($News) {
    json ($News->listNewsCate($id,$from,$limit,$sort));
});



/*
*   http://test.oneway.vn/api/api-v3/index.php/news-related/:slug|id/:from[/:limit/:sort]
*/
$router->get('/news-related/:id/:from', function ($id,$from) use ($News) {
    json ($News->listNewsRel($id,$from));
});
$router->get('/news-related/:id/:from/:limit', function ($id,$from,$limit) use ($News) {
    json ($News->listNewsRel($id,$from,$limit));
});
$router->get('/news-related/:id/:from/:limit/:sort', function ($id,$from, $limit, $sort) use ($News) {
    json ($News->listNewsRel($id,$from,$limit,$sort));
});


/*
*   http://test.oneway.vn/api/api-v3/index.php/news-item/:slug|:id/:fields
*/
$router->get('/news-item/:id', function ($id) use ($News) {
    json ($News->newsItem($id));
});
$router->get('/news-item/:id/:fields', function ($id,$fields) use ($News) {
    json ($News->newsItem($id,$fields));
});


/*
*   http://test.oneway.vn/api/api-v3/index.php/count-news
*/
$router->get('/count-news', function () use ($News) {
    json ($News->countAll());
});

/*
*   http://test.oneway.vn/api/api-v3/index.php/count-news/:id
*/
$router->get('/count-news/:id', function ($id) use ($News) {
    json ($News->countCate($id));
});


/*
*   http://test.oneway.vn/api/api-v3/index.php/random-news
*/
$router->get('/random-news', function () use ($News) {
    json ($News->randomAll());
});

/*
*   http://test.oneway.vn/api/api-v3/index.php/random/:slug|:id/:from[/:limit/:sort]
*/
$router->get('/random-news/:id/:from', function ($id,$from) use ($News) {
    json ($News->randomCate($id,$from));
});
$router->get('/random-news/:id/:from/:limit', function ($id,$from,$limit) use ($News) {
    json ($News->randomCate($id,$from,$limit));
});


/*
*   http://test.oneway.vn/api/api-v3/index.php/search-news/:keyword
*/
$router->get('/search-news/:keyword', function ($keyword) use ($News) {
    json( $News->search($keyword) );
});

/*
*   http://test.oneway.vn/api/api-v3/index.php/search-news/:keyword/:category
*/
$router->get('/search-news/:keyword/:category', function ($keyword, $category) use ($News) {
    json( $News->search($keyword, $category) );
});




// TEST area
$router->get('/test', function () {
    echo duration('public/small.mp3');
});




/*-----------------------------------------------------------------------------------------------
*	Routes end here
-------------------------------------------------------------------------------------------------*/
$router->notFound(function () { echo '<h1>404 - Not Found!</h1>'; }); $router->run();
?>