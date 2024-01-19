<?php


function showAlert($icon, $title, $message, $redirect = null)
{
    echo "
        <script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    icon: '$icon',
                    title: '$title',
                    html: '<p class=\"p-popup\">$message</p>',
                    showConfirmButton: true, 
                    confirmButtonText: 'OK',
                }).then(() => {
                    " . ($redirect ? "window.location.href = '$redirect';" : '') . "
                });
            });
        </script>
        ";
}