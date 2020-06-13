<!DOCTYPE html>
<html>
<head>
    <title>Sportsfight</title>
</head>

<body>

 <h>Hi <?php echo e($content['receipent_name']??''); ?>,</p>
 <p> <?php echo $content['data']??''; ?></p>
 <h5><b>Regards </b></h5>
 <p><?php echo e($content['sender_name']??'Sportsfight'); ?></p>
</body>

</html><?php /**PATH /var/www/sportsfight.in/resources/views/emails/mail.blade.php ENDPATH**/ ?>