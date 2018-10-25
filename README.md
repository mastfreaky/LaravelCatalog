# LaravelCatalog
Test web application "Catalog" on Laravel

Implemented web application by [specifications](https://docs.google.com/document/d/10226scJsE6TzlGDOIFR0a21GfzEVv8irbBndzXwiKH8/edit)

SQL Requests:

1. `SELECT o.order_number, COUNT(op.product_id) AS products
FROM orders AS o
JOIN orders_products AS op 
ON o.id = op.order_id
GROUP BY o.id`

2. `SELECT o.order_number, COUNT(op.product_id) AS products
FROM orders AS o
JOIN orders_products AS op 
ON o.id = op.order_id
GROUP BY o.id
HAVING products > 10`

3. `SELECT op.order_id, COUNT(product_id) product_count 
FROM orders_products AS op 
WHERE op.product_id = op.product_id 
GROUP BY op.order_id 
ORDER BY COUNT(op.product_id) DESC LIMIT 2`