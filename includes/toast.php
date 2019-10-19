<?php
function toast(string $type, string $message)
{
    $type = strtolower($type);
    $title = "";
    $icon = "";

    switch ($type) {
        case 'success':
            $type = 'success';
            $title = "Success";
            $icon = "thumbs-up";
            break;

        case 'fail':
            $type = 'danger';
            $title = "Failed";
            $icon = "thumbs-down";
            break;
    }
    echo <<<TOAST
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000" style="position: absolute; top: 0; right: 0;">
        <div class="toast-header">
            <i class="far fa-$icon"></i>&nbsp;
            <strong class="mr-auto text-$type">$title</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            $message
        </div>
    </div>
TOAST;
}