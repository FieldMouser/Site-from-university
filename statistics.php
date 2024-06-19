<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Статистика посещений</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <h1>Статистика посещений</h1>
    
    <form method="GET" action="">
        <label for="startDate">Начальная дата:</label>
        <input type="date" id="startDate" name="startDate" value="<?php echo isset($_GET['startDate']) ? $_GET['startDate'] : ''; ?>">

        <label for="endDate">Конечная дата:</label>
        <input type="date" id="endDate" name="endDate" value="<?php echo isset($_GET['endDate']) ? $_GET['endDate'] : ''; ?>">

        <button type="submit">Фильтровать</button>
    </form>

    <canvas id="visitChart"></canvas>

    <?php
    $mysqli = new mysqli('localhost', 'user101', 'gun_fedora_user_101', 'user101');

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $query = "SELECT page_name, SUM(visit_count) AS total_visits, MIN(visit_date) AS first_visit, MAX(visit_date) AS last_visit FROM page_visits WHERE 1=1";
    $params = [];

    if (isset($_GET['startDate']) && $_GET['startDate'] != '') {
        $query .= " AND visit_date >= ?";
        $params[] = $_GET['startDate'];
    }

    if (isset($_GET['endDate']) && $_GET['endDate'] != '') {
        $query .= " AND visit_date <= ?";
        $params[] = $_GET['endDate'];
    }

    $query .= " GROUP BY page_name";

    $stmt = $mysqli->prepare($query);

    if ($params) {
        $stmt->bind_param(str_repeat('s', count($params)), ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $pages = [];
    $counts = [];
    $visitsData = [];

    while ($row = $result->fetch_assoc()) {
        $pages[] = $row['page_name'];
        $counts[] = $row['total_visits'];
        $visitsData[] = $row;
    }

    $stmt->close();

    $tableQuery = "SELECT * FROM page_visits WHERE 1=1";
    $tableParams = [];

    if (isset($_GET['startDate']) && $_GET['startDate'] != '') {
        $tableQuery .= " AND visit_date >= ?";
        $tableParams[] = $_GET['startDate'];
    }

    if (isset($_GET['endDate']) && $_GET['endDate'] != '') {
        $tableQuery .= " AND visit_date <= ?";
        $tableParams[] = $_GET['endDate'];
    }

    $tableQuery .= " ORDER BY visit_date DESC";

    $tableStmt = $mysqli->prepare($tableQuery);

    if ($tableParams) {
        $tableStmt->bind_param(str_repeat('s', count($tableParams)), ...$tableParams);
    }

    $tableStmt->execute();
    $tableResult = $tableStmt->get_result();
    ?>

    <h2>Таблица посещений</h2>
    <table id="visitsTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Страница</th>
                <th>Количество посещений</th>
                <th>Последнее посещение</th>
                <th>Дата посещения</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $tableResult->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['page_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['visit_count']); ?></td>
                    <td><?php echo htmlspecialchars($row['last_visit']); ?></td>
                    <td><?php echo htmlspecialchars($row['visit_date']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <script>
        var ctx = document.getElementById('visitChart').getContext('2d');
        var visitChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($pages); ?>,
                datasets: [{
                    label: 'Количество посещений',
                    data: <?php echo json_encode($counts); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        $(document).ready(function() {
            $('#visitsTable').DataTable();
        });
    </script>

</body>
</html>
