<?php

/**
 * Get all the categories
 * @param PDO $pdo
 * @return array|null
 */
function getCategories(PDO $pdo): array|null
{
    $sql = "SELECT * from categories";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}
