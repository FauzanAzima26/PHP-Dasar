<?php

function query($query)
{
  global $connection;
  $result = mysqli_query($connection, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}


// add categories
function store_category($data)
{
  global $connection;

  $title = sanitize($data['title']);
  $slug = sanitize($data['slug']);

  // $query = "INSERT INTO categories (title, slug) VALUES ('$title', '$slug')";

  $stmt = $connection->prepare("INSERT INTO categories (title, slug) VALUES (?, ?)");
  $stmt->bind_param("ss", $title, $slug);
  $stmt->execute();

  return $stmt->affected_rows;
}

// delete categories
function delete_category($id)
{
  global $connection;
  $query = "DELETE FROM categories WHERE id_categories = $id";
  mysqli_query($connection, $query);
  return mysqli_affected_rows($connection);
}

// edit categories
function update_category($data)
{
  global $connection;

  $id = (int)$data['id_categories'];

  $title = sanitize($data['title']);
  $slug = sanitize($data['slug']);

  $stmt = $connection->prepare("UPDATE categories SET title = ?, slug = ? WHERE id_categories = ?");
  $stmt->bind_param("ssi", $title, $slug, $id);
  $stmt->execute();

  return $stmt->affected_rows;
}

// add films
function add_films($data)
{
  global $connection;

  $url = sanitize($data['url']);
  $title = sanitize($data['title']);
  $slug = sanitize($data['slug']);
  $description = sanitize($data['description']);
  $release_date = sanitize($data['release_date']);
  $studio = sanitize($data['studio']);
  $category_id = sanitize((int)$data['category_id']);

  $stmt = $connection->prepare("INSERT INTO films (url, title, slug, description, release_date, studio, category_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssssi", $url, $title, $slug, $description, $release_date, $studio, $category_id);
  $stmt->execute();

  return $stmt->affected_rows;
}

// edit film
function edit_film($data)
{
  global $connection;

  $id = (int)$data['id_film'];

  $title = sanitize($data['title']);
  $slug = sanitize($data['slug']);
  $description = sanitize($data['description']);
  $release_date = sanitize($data['release_date']);
  $studio = sanitize($data['studio']);
  $category_id = sanitize((int)$data['category_id']);

  $stmt = $connection->prepare("UPDATE films SET title = ?, slug = ?, description = ?, release_date = ?, studio = ?, category_id = ? WHERE id_film = ?");
  $stmt->bind_param("sssssii", $title, $slug, $description, $release_date, $studio, $category_id, $id);
  $stmt->execute();
  return $stmt->affected_rows;
}

// delete film
function delete_film($id)
{
  global $connection;
  $query = "DELETE FROM films WHERE id_film = $id";
  mysqli_query($connection, $query);
  return mysqli_affected_rows($connection);
}

// add users
function add_users($data)
{
  global $connection;

  $username = sanitize($data['username']);
  $email = sanitize($data['email']);
  $role = sanitize($data['role']);
  $password = sanitize(password_hash($data['password'], PASSWORD_BCRYPT));

  $stmt = $connection->prepare("INSERT INTO users (username, email, role, password) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $username, $email, $role, $password);
  $stmt->execute();

  return $stmt->affected_rows;
}

// delete user
function delete_users($id)
{
  global $connection;
  // query
  $query = "DELETE FROM users WHERE id_user = $id";
  mysqli_query($connection, $query);
  return mysqli_affected_rows($connection); 
}

// edit user
function update_users($data)
{
  global $connection;

  $id = (int)$data['id_user'];

  $username = sanitize($data['username']);
  $email = sanitize($data['email']);
  $role = sanitize($data['role']);
  $password = sanitize(password_hash($data['password'], PASSWORD_BCRYPT));

  // update query
  $stmt = $connection->prepare("UPDATE users SET username = ?, email = ?, role = ?, password = ? WHERE id_user = ?");
  $stmt->bind_param("ssssi", $username, $email, $role, $password, $id);
  $stmt->execute();

  return $stmt->affected_rows;
}
