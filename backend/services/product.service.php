<?php
class ProductService
{
    private $db;

    public function __construct()
    {
        $conn = new Db();
        $this->db = $conn->_db;
    }

    public function save($product)
    {
        $query =
            'INSERT INTO products (name, cat_id, price, description, image) values (:name, :cat_id, :price, :description, :image)';

        $qp = $this->db->prepare($query);
        $qp->bindValue(':name', $product->name());
        $qp->bindValue(':cat_id', $product->catId());
        $qp->bindValue(':price', $product->price());
        $qp->bindValue(':description', $product->description());
        $qp->bindValue(':image', $product->image());
        try {
            $qp->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getProducts()
    {
        $query = 'SELECT * FROM products ORDER BY id';

        $result = $this->db->query($query);

        $array = [];
        if ($result->rowcount() != 0) {
            while ($row = $result->fetch()) {
                $array[] = new Product(
                    $row->id,
                    $row->name,
                    $row->cat_id,
                    $row->price,
                    $row->description,
                    $row->image
                );
            }
        }
        return $array;
    }

    public function getLastProducts($limit = 5)
    {
        $query = 'SELECT * FROM products ORDER BY id DESC LIMIT ' . $limit;

        $result = $this->db->query($query);

        $array = [];
        if ($result->rowcount() != 0) {
            while ($row = $result->fetch()) {
                $array[] = new Product(
                    $row->id,
                    $row->name,
                    $row->cat_id,
                    $row->price,
                    $row->description,
                    $row->image
                );
            }
        }
        return $array;
    }

    public function getProductsByCategory($categoryId)
    {
        $query = 'SELECT * FROM products WHERE cat_id="' . $categoryId . '"';

        $result = $this->db->query($query);

        $array = [];
        if ($result->rowcount() != 0) {
            while ($row = $result->fetch()) {
                $array[] = new Product(
                    $row->id,
                    $row->name,
                    $row->cat_id,
                    $row->price,
                    $row->description,
                    $row->image
                );
            }
        }
        return $array;
    }

    public function getProduct($id)
    {
        $query = 'SELECT * FROM products WHERE id="' . $id . '"';
        $result = $this->db->query($query);
        $row = $result->fetch();
        if ($result->rowcount() != 0) {
            return new Product(
                $row->id,
                $row->name,
                $row->cat_id,
                $row->price,
                $row->description,
                $row->image
            );
        }
        return null;
    }

    public function deleteProduct($productId)
    {
        $query = 'DELETE FROM products WHERE id="' . $productId . '"';
        $qp = $this->db->prepare($query);
        $qp->execute();
        return true;
    }

    public function deleteProductByCategoryId($categoryId)
    {
        $query = 'DELETE FROM products WHERE cat_id="' . $categoryId . '"';
        $qp = $this->db->prepare($query);
        $qp->execute();
        return true;
    }

    public function editProduct($product)
    {
        $name = $this->db->quote($product->name());
        $price = $this->db->quote($product->price());
        $description = $this->db->quote($product->description());
        $catId = $this->db->quote($product->catId());
        $image = $this->db->quote($product->image());

        $query =
            'UPDATE products SET name=' .
            $name .
            ', price=' .
            $price .
            ', description=' .
            $description .
            ', cat_id=' .
            $catId .
            ', image=' .
            $image .
            ' WHERE id=' .
            $product->id();
        $qp = $this->db->prepare($query);
        try {
            $qp->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}

?>
