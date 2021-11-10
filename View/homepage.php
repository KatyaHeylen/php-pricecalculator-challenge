<?php require 'includes/header.php' ?>
<!-- this is the view, try to put only simple if's and loops here.
Anything complex should be calculated in the model -->
<section class="main">
    <h1 class="title">Hello from homepage</h1>
    <form action="" method="post">
        <label for="customers">Choose a customer</label>
        <select name="customerName">
            <?php
            if (isset($customers)) {
                foreach ($customers as $key => $v) {
                    echo "<option value='{$v->getId()}'> {$v->getFirstName()}  {$v->getLastName()} </option>";
                }
            }
            ?>
        </select>
        <br><br>

        <label for="products">Choose a product</label>
        <select name="productName">
            <?php
            if (isset($products)) {
                foreach ($products as $key => $z) {
                    echo "<option value='{$z->getId()}'> {$z->getName()} </option>";
                }
            }
            ?>
        </select>
        <br><br>
        <input type="submit" value="Submit" name="submit">
    </form>
    <container>
        <p>You have chosen:</p>
        <?php if (isset($_POST['submit'])) { ?>
        <div>
            <span class="customerName"><?php echo $customerName;?></span>
            <span class="productName"><?php echo $productName; ?></span>
            <span class="productPrice"><?php echo $productPrice/100 . "€"; ?></span>
        </div>
    </container>
        <p>Price after discount:</p>
        <span><?php echo round($priceCalculator/100, 2) . "€";?></span>

<?php }?>

    <?php
    if (isset($_POST['submit'])) {
        // var_dump($selectedCustomer);
        // var_dump($customerGroups);
        // var_dump($productName);
//        var_dump($fixedDiscount);
//        var_dump($variableDiscount);
    }

    ?>
</section>
<?php require 'includes/footer.php' ?>
