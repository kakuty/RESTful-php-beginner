<?php
// Require headers
header("Access-Control-Allo-Origin: *");
header("Content-Type: application/json;charset=UTF-8");

// Include database and object files
include_once('../config/database.php');
include_once('../objects/product.php');

// Instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// Initializ products
$product = new Product($db);

// Query products
$stmt = $product->read();
$num = $stmt->rowCount();

// Check if more than 0 record found
if ($num > 0) {
    // product array
    $product_arr = array();
    $product_arr['records']=array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        // this willmake $row['name'] to just $name only
        extract($row);

        $product_item = array('id' => $id,
            'name' => $name,
            'description' => html_entity_decode($description),
            'price' => $price,
            'category_id' => $category_id
            );

        array_push($product_arr['records'], $product_item);
    }

    echo json_encode($product_arr);
} else {
    echo json_encode(
        array('message' => 'No product found'));
}
