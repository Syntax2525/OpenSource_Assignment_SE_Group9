<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/config/db.php';

$pageTitle = 'Statistics Dashboard';
require_once __DIR__ . '/includes/header.php';

$stmt = $pdo->prepare('SELECT COUNT(*) FROM projects');
$stmt->execute();
$totalProjects = (int) $stmt->fetchColumn();

$statuses = ['Pending', 'In Progress', 'Completed', 'Cancelled'];
$counts = [];

foreach ($statuses as $status) {
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM projects WHERE status = ?');
    $stmt->execute([$status]);
    $counts[$status] = (int) $stmt->fetchColumn();
}

$stmt = $pdo->prepare('SELECT status, COUNT(*) AS total FROM projects GROUP BY status');
$stmt->execute();
$chartData = [];
foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    $chartData[$row['status']] = (int) $row['total'];
}

$chartLabels = $statuses;
$chartValues = [];
foreach ($statuses as $status) {
    $chartValues[] = $chartData[$status] ?? 0;
}

$stmt = $pdo->prepare('SELECT project_name, project_manager, status, start_date, end_date FROM projects ORDER BY created_at DESC, id DESC LIMIT 5');
$stmt->execute();
$recentProjects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <div class="page-header">
        <div>
            <h1 class="page-title">Statistics Dashboard</h1>
            <p class="subtitle">A professional overview of your software project portfolio.</p>
        </div>
        <a class="button secondary" href="dashboard.php">Dashboard Home</a>
    </div>

    <div class="stats-grid">
        <div class="stat-card blue">
            <div class="stat-icon">📁</div>
            <div>
                <h3>Total Projects</h3>
                <p><?= $totalProjects ?></p>
            </div>
        </div>

        <div class="stat-card amber">
            <div class="stat-icon">⏳</div>
            <div>
                <h3>Pending</h3>
                <p><?= $counts['Pending'] ?></p>
            </div>
        </div>

        <div class="stat-card teal">
            <div class="stat-icon">⚙️</div>
            <div>
                <h3>In Progress</h3>
                <p><?= $counts['In Progress'] ?></p>
            </div>
        </div>

        <div class="stat-card green">
            <div class="stat-icon">✅</div>
            <div>
                <h3>Completed</h3>
                <p><?= $counts['Completed'] ?></p>
            </div>
        </div>

        <div class="stat-card red">
            <div class="stat-icon">🚫</div>
            <div>
                <h3>Cancelled</h3>
                <p><?= $counts['Cancelled'] ?></p>
            </div>
        </div>
    </div>

    <div class="chart-grid">
        <div class="card chart-card">
            <h3>Project Status Distribution</h3>
            <canvas id="statusPieChart" height="220"></canvas>
        </div>

        <div class="card chart-card">
            <h3>Project Status Counts</h3>
            <canvas id="statusBarChart" height="220"></canvas>
        </div>
    </div>

    <div class="card">
        <div class="page-header compact-header">
            <div>
                <h2 class="section-title">Recent Projects</h2>
                <p class="subtitle">Latest updates from your project pipeline.</p>
            </div>
            <a class="button secondary" href="view_projects.php">View All</a>
        </div>

        <div class="table-wrap">
            <table>
                <tr>
                    <th>Project Name</th>
                    <th>Project Manager</th>
                    <th>Status</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>
                <?php if (!empty($recentProjects)): ?>
                    <?php foreach ($recentProjects as $project): ?>
                        <tr>
                            <td><?= htmlspecialchars($project['project_name'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($project['project_manager'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><span class="status-pill"><?= htmlspecialchars($project['status'], ENT_QUOTES, 'UTF-8') ?></span></td>
                            <td><?= htmlspecialchars($project['start_date'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($project['end_date'], ENT_QUOTES, 'UTF-8') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="empty-state">No projects have been added yet.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const statusLabels = <?= json_encode($chartLabels) ?>;
    const statusValues = <?= json_encode($chartValues) ?>;

    const pieCtx = document.getElementById('statusPieChart');
    if (pieCtx) {
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: statusLabels,
                datasets: [{
                    data: statusValues,
                    backgroundColor: ['#f59e0b', '#3b82f6', '#10b981', '#ef4444']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    }

    const barCtx = document.getElementById('statusBarChart');
    if (barCtx) {
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: statusLabels,
                datasets: [{
                    label: 'Projects',
                    data: statusValues,
                    backgroundColor: ['#f59e0b', '#3b82f6', '#10b981', '#ef4444']
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 }
                    }
                }
            }
        });
    }
</script>
