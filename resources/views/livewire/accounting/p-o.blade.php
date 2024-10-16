<div class="w-full" >
    <div class="w-fit bg-gray-200 rounded-lg pl-1 pr-1 pt-1 pb-1 m-1">



        <div id="document">
            <div id="documenthead">
                <div id="metadata">
                    <table>
                        <tr class="metadata-purchaseorderid">
                            <th>Purchase order</th>
                            <td>{purchaseorderid}</td>
                        </tr>
                        <tr class="metadata-warehouse">
                            <th>Warehouse</th>
                            <td>{warehouse name}</td>
                        </tr>
                        <tr class="metadata-date">
                            <th>Date</th>
                            <td>01-01-2019</td>
                        </tr>
                        <tr class="metadata-delivery-date">
                            <th>Expected delivery date</th>
                            <td>01-01-2019</td>
                        </tr>
                        <tr class="metadata-supplier-orderid">
                            <th>Order number supplier</th>
                            <td>{order number supplier}</td>
                        </tr>
                    </table>
                </div>
                <div id="address">
                    Example company B.V.<br>
                    Dorpsstraat 21<br>
                    3928 AM Utrecht<br>
                    Nederland
                </div>
            </div>

            <div class="content">
                <div class="template-custom-html-start">{template-start-text}</div>

                <div class="purchaseorder-remarks">
                    <div class="purchaseorder-remarks-heading">Remarks</div>
                    <div>{remarks}</div>
                </div>

                <div id="products" class="products">
                    <table>
                        <thead>
                        <tr>
                            <th class="column-productcode-supplier">Supplier</th>
                            <th class="column-productcode">Product code</th>
                            <th class="column-name">Name</th>
                            <th class="right column-amount">Amount</th>
                            <th class="right column-price">Price</th>
                            <th class="right column-total-price">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="column-productcode-supplier">{productcode supplier}</td>
                            <td class="column-productcode">{productcode}</td>
                            <td class="column-name">
                                <div class="name">{name}</div>
                                <span class="productfield">{productfield-title}: {value}}</span>
                            </td>
                            <td class="right column-amount">{amount}</td>
                            <td class="right column-price">{price}</td>
                            <td class="right column-total-price">{total price}</td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="3" class="align-right"><strong>Total:</strong></td>
                            <td id="totalamount" class="align-right nowrap column-amount">{total amount}</td>
                            <td class="column-price"></td>
                            <td id="totalprice" class="align-right nowrap column-total-price">{total price}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="template-custom-html-end">{template-end-text}</div>
            </div>
        </div>




    </div>
</div>