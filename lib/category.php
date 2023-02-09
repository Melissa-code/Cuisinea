<?php

/**
 * Get all the categories
 * @param PDO $pdo
 * @return array
 */
function getCategories(PDO $pdo): array
{
    $sql = "SELECT * from categories";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}
