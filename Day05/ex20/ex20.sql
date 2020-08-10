SELECT film.id_genre AS id_genre, genre.name AS name_genre, distrib.id_distrib AS id_distrib, distrib.name AS name_distrib, film.title AS title_film FROM film
LEFT JOIN distrib ON film.id_distrib = distrib.id_distrib
LEFT JOIN genre ON genre.id_genre = film.id_genre
WHERE film.id_genre BETWEEN 4 AND 8;