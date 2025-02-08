-- Нужно отобразить все типы и кол-во мотоциклов в каждом типе и учесть, что мотоцикл может быть уже снят с производства.

SELECT
    t.name AS type,
    COUNT(m.id) AS active_motorcycles
FROM types t
         LEFT JOIN motorcycles m ON t.id = m.type_id AND m.discontinued = 0
GROUP BY t.id, t.name;