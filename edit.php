<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDit to do list</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="app.css">    
</head>
<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-sm">
                <div class="bg-dark text-white py-2  d-flex justify-content-center">
                    <h1>Edit to do list data </h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
            <?php
            if (isset($_GET['empty'])) {
                echo '<div class="alert alert-warning alert-dismissible" role="alert">
                <strong>ERROR!</strong> Data field remained empty. Fill up the field and try again.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
            if (isset($_GET['success'])) {
                echo '<div class="alert alert-success alert-dismissible" role="alert">
                <strong>SUCCESSFUL!</strong> Data has inserted successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
            ?>
            </div> 
        </div>
        <div class="row">
            <div class="col-sm">
                <?php
                
                require_once 'TodoList.php';
                $todoListData = new TodoList();
                $table = 'tbl_todos';
                // $order_by = ['order_by' => 'id DESC'];
                if (isset($_GET['edit_id'])) {
                    $id = $_GET['edit_id'];
                }
                // Conditional fetching of data
                $whereCond = [
                    'where' => ['id' => $id],
                    'return_type' => 'single',
                ];
                $resultData = $todoListData->select($table, $whereCond);
                ?>
                <form action="ProcessData.php" method="post" class="mb-4">
                    <div class="mb-3">
                        <label for="data" class="form-label">To do data</label>
                        <input type="text" class="form-control" id="data" name="data" value="<?php echo isset($resultData->data) ? $resultData->data : '';?>" placeholder="Input to do data.....">
                    </div>
                    <input type="hidden" name="action" value="verify">
                    <input type="hidden" name="id" value="<?php echo $resultData->id ;?>">
                    <button type="submit" value="update-todo" name="submit" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i> Update</button>
                    <a href="index.php" class="btn btn-sm btn-success"><i class="bi bi-skip-backward-circle-fill"></i> Go Back</a>
                </form>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm">
                <div class="footer-area bg-dark text-white d-flex justify-content-center py-2">
                    <span>All rights reserved &copy; <?php echo date('Y');?></span>
                </div>
            </div>
        </div>   
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</html>