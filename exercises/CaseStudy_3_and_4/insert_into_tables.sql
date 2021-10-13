USE f32ee;

INSERT INTO case4Drinks VALUES
    (1, 'Just Java', 2.00),
    (2, 'Cafe au Lait, Single', 2.00),
    (3, 'Cafe au Lait, Double', 3.00),
    (4, 'Iced Cappucino, Single', 4.75),
    (5, 'Iced Cappucino, Double', 5.75);

INSERT INTO case4Orders VALUES
    (1, 1, 2),
    (1, 3, 2),
    (2, 5, 3),
    (3, 4, 3),
    (4, 1, 1),
    (5, 2, 4),
    (6, 3, 1),
    (6, 5, 5),
    (7, 1, 1);