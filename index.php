<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Todo List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="app.css">    
</head>
<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-sm">
                <div class="bg-dark text-white py-2  d-flex justify-content-center">
                    <h1>To do list in Object Oriented PHP </h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
            <?php
            // Validation messages included
            require_once 'validationMessages.php';
            ?>
            </div> 
        </div>
        <div class="row">
            <div class="col-sm">
                <form action="ProcessData.php" method="post">
                    <div class="mb-3">
                        <label for="data" class="form-label">To do data</label>
                        <input type="text" class="form-control" id="data" name="data" value="<?php echo isset($data) ? $data : '';?>" placeholder="Input to do data.....">
                    </div>
                    <input type="hidden" name="action" value="verify">
                    <button type="submit" value="insert-todo" name="submit" class="btn btn-sm btn-primary"><i class="bi bi-upload"></i> Submit</button>
                    <a href="index.php" class="btn btn-sm btn-warning"><i class="bi bi-arrow-repeat"></i> Refresh</a>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <table class="table table-sm table-striped table-hover my-2">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" width="2%">#</th>
                            <th scope="col" width="84%">To do list</th>
                            <th scope="col" style="text-align:right;padding-right:10px;" width="14%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once 'TodoList.php';
                        require_once 'validationMessages.php';
                        $todoListData = new TodoList();
                        $table = 'tbl_todos';
                        $order_by = ['order_by' => 'id DESC'];
                        $resultData = $todoListData->select($table, $order_by);
                        if ($resultData) {
                            $i = 1;
                            foreach ($resultData as $result) {
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $i++; ?></th>
                                    <td><?php echo $result->data; ?></td>
                                    <td>
                                        <a href="delete.php?delete_id=<?php echo $result->id; ?>" class="btn btn-sm btn-danger py-0 float-end"><i class="bi bi-trash"></i> Delete</a>
                                        <a href="edit.php?edit_id=<?php echo $result->id; ?>" class="btn btn-sm btn-primary py-0 float-end"><i class="bi bi-pencil-square"> </i> Edit</a>
                                    </td>   
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="message">
                                <span><strong>SORRY !</strong> No data is available in the database at this moment !</span>
                            </div>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
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