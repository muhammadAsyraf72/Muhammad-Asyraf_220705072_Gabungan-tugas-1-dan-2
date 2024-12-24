<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
        <h2 class="text-center mb-4">List Peserta</h2>
        
        <!-- Tombol Add User -->
        <div class="mb-3">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">Tambah Peserta</button>
        </div>
        
        <!-- Tabel Users -->
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>No</th> <!-- Kolom No -->
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection
                $conn = new mysqli('localhost', 'root', '', 'konsep');

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch data from users table
                $sql = "SELECT * FROM users";
                $result = $conn->query($sql);

                // Variabel untuk nomor urut
                $no = 1;

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . $no++ . "</td> <!-- Menampilkan nomor urut -->
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['phone']}</td>
                            <td>
                                <button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#updateUserModal' onclick='loadUserData({$row['id']}, \"{$row['name']}\", \"{$row['email']}\", \"{$row['phone']}\")'>Update</button>
                                <button class='btn btn-danger btn-sm' onclick='confirmDelete({$row['id']})'>Delete</button>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No records found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Add User -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="add_user.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Tambah Peserta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Update User -->
    <div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="update_user.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateUserModalLabel">Update Peserta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="update_id" name="id">
                        <div class="form-group">
                            <label for="update_name">Name</label>
                            <input type="text" class="form-control" id="update_name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="update_email">Email</label>
                            <input type="email" class="form-control" id="update_email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="update_phone">Phone</label>
                            <input type="text" class="form-control" id="update_phone" name="phone" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk mengisi data di modal update -->
    <script>
        function loadUserData(id, name, email, phone) {
            document.getElementById('update_id').value = id;
            document.getElementById('update_name').value = name;
            document.getElementById('update_email').value = email;
            document.getElementById('update_phone').value = phone;
        }

        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this user?")) {
                window.location.href = "delete_user.php?id=" + id;
            }
        }
    </script>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
