<!DOCTYPE html>
<html>
<body style="font-family: Georgia, serif; padding: 20px; color: #333;">
    <p>Dear {{ $guestName }},</p>
    
    <p>Thank you for confirming your {{ $isAttending ? 'attendance at' : 'RSVP for' }} our wedding celebration.</p>
    
    @if($isAttending)
    <p>We are delighted to know that you will be joining us on this special day. Please find attached your wedding invitation with all the details.</p>
    @else
    <p>Although you will not be able to attend, we sincerely appreciate your thoughtful response. Please find attached a special message from us.</p>
    @endif
    
    <p style="margin-top: 30px;">
        <strong>Warm Regards,</strong><br>
        George & Carmen
    </p>
</body>
</html>