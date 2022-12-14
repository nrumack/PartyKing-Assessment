<?php
    use DVDoug\BoxPacker\Packer;
    use DVDoug\BoxPacker\Test\TestBox;  // use your own `Box` implementation
    use DVDoug\BoxPacker\Test\TestItem; // use your own `Item` implementation

/* function packing_response ()  */
function packing_response($description, $height, $depth, $width, $weight) {

	$packer = new Packer();

    /*
     * Add choices of box type - in this example the dimensions are passed in directly via constructor,
     * but for real code you would probably pass in objects retrieved from a database instead
     */
    $packer->addBox(new TestBox('XS', 120, 180, 80, 0, 120, 180, 80, 5000));
	$packer->addBox(new TestBox('XXL', 600, 600, 600, 0, 600, 600, 600, 20000));
/*     $packer->addBox(new TestBox('Le grande box', 600, 600, 600, 20000)); */

    /*
     * Add items to be packed - e.g. from shopping cart stored in user session. Again, the dimensional information
     * (and keep-flat requirement) would normally come from a DB
     */
/*     $packer->addItem(new TestItem('Item 1', 250, 250, 12, 200, true), 1); // item, quantity
    $packer->addItem(new TestItem('Item 2', 250, 250, 12, 200, true), 2);
    $packer->addItem(new TestItem('Item 3', 250, 250, 24, 200, false), 1); */
	$packer->addItem(new TestItem($description, $width, $height, $depth, $weight, true), 1);


    $packedBoxes = $packer->pack();

    echo "These items fitted into " . count($packedBoxes) . " box(es)" . PHP_EOL;
    foreach ($packedBoxes as $packedBox) {
        $boxType = $packedBox->getBox(); // your own box object, in this case TestBox
        echo "This box is a {$boxType->getReference()}, it is {$boxType->getOuterWidth()}mm wide, {$boxType->getOuterLength()}mm long and {$boxType->getOuterDepth()}mm high" . PHP_EOL;
        echo "The combined weight of this box and the items inside it is {$packedBox->getWeight()}g" . PHP_EOL;

        echo "The items in this box are:" . PHP_EOL;
        $packedItems = $packedBox->getItems();
        foreach ($packedItems as $packedItem) { // $packedItem->getItem() is your own item object, in this case TestItem
            echo $packedItem->getItem()->getDescription() . PHP_EOL;
        }
    }
}
    