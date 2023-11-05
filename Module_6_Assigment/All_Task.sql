/*task-1*/

SELECT C.CustomerID, C.Name, C.Email, C.Location, COUNT(O.OrderID) AS TotalOrders
FROM Customers C
LEFT JOIN Orders O ON C.CustomerID = O.CustomerID
GROUP BY C.CustomerID, C.Name, C.Email, C.Location
ORDER BY TotalOrders DESC;

/*task-2*/

SELECT P.Name AS ProductName, OI.Quantity, OI.Quantity * OI.UnitPrice AS TotalAmount
FROM Order_Items OI
INNER JOIN Products P ON OI.ProductID = P.ProductID
ORDER BY OI.OrderID ASC;

/*task-3*/

SELECT C.Name AS CategoryName, SUM(OI.Quantity * OI.UnitPrice) AS TotalRevenue
FROM Categories C
LEFT JOIN Products P ON C.CategoryID = P.CategoryID
LEFT JOIN Order_Items OI ON P.ProductID = OI.ProductID
GROUP BY C.CategoryID, C.Name
ORDER BY TotalRevenue DESC;

/*task-4*/

SELECT C.Name AS CustomerName, SUM(OI.Quantity * OI.UnitPrice) AS TotalPurchaseAmount
FROM Customers C
LEFT JOIN Orders O ON C.CustomerID = O.CustomerID
LEFT JOIN Order_Items OI ON O.OrderID = OI.OrderID
GROUP BY C.CustomerID, C.Name
ORDER BY TotalPurchaseAmount DESC
LIMIT 5;

