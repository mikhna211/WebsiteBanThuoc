<?php include('header.php'); ?>

<?php

    if(!isset($_SESSION['admin_logged_in'])){
        header('location: login.php');
        exit;
    }

?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include('sidemenu.php') ?>

        <!-- Main Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Tài khoản Admin</h1>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr class="text-center">
                        <th scope="col">ID</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td><?php echo $_SESSION['admin_id']; ?></td>
                        <td><?php echo $_SESSION['admin_name']; ?></td>
                        <td><?php echo $_SESSION['admin_email']; ?></td>
                    </tr>
                </tbody>
            </table>
        </main>
    </div>
</div>

<script src="admin.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>