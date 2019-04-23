SELECT booking.id, booking.begin_date, booking.end_date, room.name, users.username FROM booking
INNER JOIN room ON booking.room_id=room.id
INNER JOIN users ON users.id=booking.user_id
WHERE booking.begin_date >= '2019-04-01' AND booking.end_date <= '2019-04-30';

