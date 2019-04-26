SELECT booking.id, booking.begin_date, booking.end_date, room.name, users.username FROM booking INNER JOIN room ON booking.room_id=room.id INNER JOIN users ON users.id=booking.user_id WHERE booking.begin_date >= `2019-04-22` AND booking.end_date <= `2019-04-22`;

WHERE begin_date <= '2019-04-22' AND end_date >= '2019-04-22'


INSERT INTO booking (begin_date, end_date, nb_person, options, room_id, user_id, total_price) VALUES ('2019-04-22', '2019-04-30', 2, 'dej_separateBed', 2, 4, 100.00);