SELECT UPPER(user_card.last_name) AS NAME, user_card.first_name, subscription.price 
from user_card INNER JOIN member ON member.id_member = user_card.id_user
INNER JOIN subscription ON member.id_sub = subscription.id_sub
WHERE subscription.price > 42 
ORDER BY user_card.last_name ASC, user_card.first_name ASC;
