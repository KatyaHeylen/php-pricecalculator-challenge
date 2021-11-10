# PHP Price Calculator

PHP Price Calculator is a challenge/exercise that I had to do during my BeCode training.  
The purpose of it is to apply basic OOP principles, import data from a database and learn how to use MVC

## The mission

Today you are going to combine your new awesome OOP powers with a database. To give you some time to get familiar with a database, this exercise only requires read access, not write access.

Make a price calculator with the followings entities:

- Customer (First name, Last name)
- A customer group (Name)
- A product (product name, price in cents)

A customer belongs to a customer group, which can also belong to another group (infinite). You don't need to worry for infinite loops in this exercise.

Both a customer and a group can have a discount, which can be a percentage or a fixed amount.

## Assignment duration and type

We had 4️⃣ days to complete it (8/11 - 12/11) and it was a team exercise.  
I worked on this exercise together with [Katya Heylen](https://github.com/KatyaHeylen).

**To calculate the price:**

- for the customer group: in case of variable discounts look for the highest discount of all the groups the user has.
- if some groups have fixed discounts, count them all up.
- look which discount (fixed or variable) will give the customer the most value.
- now look at the discount of the customer.
- in case both customer and customer group have a percentage, take the largest percentage.
- first subtract fixed amounts, then percentages!
- a price can never be negative.

## Must have features

- a dropdown where you can select a Product and a Customer and you get the basic information of the product + the price.
- use a [MVC pattern](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller). You can use the [MVC Boilerplate](https://github.com/becodeorg/php-mvc-boilerplate).
- use separate objects for importing the entities with SQL, and for managing the entities.

## Nice to have features

- an actual login page for the customer
- a table where you can see in detail how the price is calculated
- the possibility to have different prices for different quantities(like 1 EUR/1 item, 0.9 EUR/100 items)
- a category page for the different products
