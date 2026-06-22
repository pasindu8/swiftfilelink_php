<?php
// Usage: setNotify('error', 'Something went wrong.');
//        setNotify('success', 'Done!');
//        setNotify('warning', 'Be careful.');

function setNotify($type, $message) {
    $_SESSION['notify'] = ['type' => $type, 'msg' => $message];
}

function showNotify() {
    if (!empty($_SESSION['notify'])) {
        $type = $_SESSION['notify']['type'];
        $msg  = htmlspecialchars($_SESSION['notify']['msg']);
        unset($_SESSION['notify']);

        $icons = [
            'success' => '✔',
            'error'   => '✖',
            'warning' => '⚠',
            'info'    => 'ℹ',
        ];
        $icon = $icons[$type] ?? 'ℹ';

        echo "
        <div class='notify-wrapper' id='notifyBox'>
            <div class='notify notify-{$type}'>
                <span class='notify-icon'>{$icon}</span>
                <span class='notify-msg'>{$msg}</span>
                <button class='notify-close' onclick='closeNotify()'>✕</button>
            </div>
        </div>
        <script>
            setTimeout(() => {
                const el = document.getElementById('notifyBox');
                if (el) el.classList.add('notify-hide');
            }, 6000);
            function closeNotify() {
                const el = document.getElementById('notifyBox');
                if (el) el.classList.add('notify-hide');
            }
        </script>
        ";
    }
}
?>