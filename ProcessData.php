<?php
    require_once 'TodoList.php';

/**
 * Process data Class
 */
class ProcessData extends TodoList
{
    /**
     * Constructor to auto activate class
     */
    public function __construct()
    {
        /**
         * Class TodoList is instantiated
         */
        $todoList = new TodoList;
        $table = 'tbl_todos';
        $accessor = $_POST['submit'];
        switch ($accessor) {
        case 'insert-todo':
            if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
                if ($_REQUEST['action'] == 'verify') {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['submit'])) {
                            $data = $todoList->validate($_POST['data']);
                            if (empty($data)) {
                                header("Location: index.php?empty");
                            } else {
                                //Array of fields
                                $fields = [
                                    'data' => $data
                                ];

                                $insertedData = $todoList->insert($table, $fields);
                                if ($insertedData) {
                                    header("Location: index.php?success");
                                }
                            }
                        }
                    }
                }
            }
            break;
        case 'update-todo':
            if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
                if ($_REQUEST['action'] == 'verify') {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['submit'])) {
                            $data = $todoList->validate($_POST['data']);
                            if (empty($data)) {
                                header("Location: index.php?empty");
                            } else {
                                if (isset($_POST['id'])) {
                                    $id = $_POST['id'];
                                }
                                //Array of fields
                                $fields = [
                                    'data' => $data
                                ];
                                $condition = ['id' => $id];
                                $updatedData = $todoList->updateWithoutPhoto($table, $fields, $condition);
                                if ($updatedData) {
                                    header("Location: index.php?updated");
                                } else {
                                    header("Location: index.php?not-updated");
                                }
                            }
                        }
                    }
                }
            }
            break;
        case 'delete-todo':
            if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
                if ($_REQUEST['action'] == 'verify') {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['submit'])) {
                            $data = $todoList->validate($_POST['data']);
                            if (empty($data)) {
                                header("Location: index.php?empty");
                            } else {
                                if (isset($_POST['id'])) {
                                    $id = $_POST['id'];
                                }
                                //Array of fields
                                $fields = [
                                    'data' => $data
                                ];
                                $condition = ['id' => $id];
                                $updatedData = $todoList->delete($table, $condition);
                                if ($updatedData) {
                                    header("Location: index.php?deleted");
                                }
                            }
                        }
                    }
                }
            }
            break;
        default:
            //echo 'ERROR';
            break;
        }
    }
}
if (isset($_POST['submit'])) {
    new ProcessData;
}
