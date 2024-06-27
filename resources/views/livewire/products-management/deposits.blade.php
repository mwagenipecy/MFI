
<div class="w-full">
    <!-- message container -->





    <div class="accordion">
        <!-- Accordion Item 1 -->
        <div class="accordion-item">
          <input type="checkbox" id="accordion-item-1" class="accordion-toggle">
          <label for="accordion-item-1" class="accordion-title w-full">CREATE NEW DEPOSITS PRODUCT</label>
          <div class="accordion-content">
            <!-- Content for Accordion Item 1 -->

            <div class="panel">
                <livewire:products-management.new-product :product_id="13"/>
            </div>



          </div>
        </div>

        @foreach(App\Models\sub_products::where('product_id','13')->get() as $subProduct)


            <div class="accordion-item">
              <input type="checkbox" id="accordion-item-3" class="accordion-toggle">
              <label for="accordion-item-3" class="accordion-title">{{$subProduct->sub_product_name}}</label>
              <div class="accordion-content">
                <!-- Content for Accordion Item 3 -->

                <div class="panel">
                    <livewire:products-management.product-data-loader :sub_id="$subProduct->id"/>
                </div>
              </div>
            </div>




            @endforeach




      </div>





















        <script>

            // Get all accordion items
        const accordionItems = document.querySelectorAll('.accordion-item');

        // Add event listener to each accordion item
        accordionItems.forEach(item => {
          const toggle = item.querySelector('.accordion-toggle');

          toggle.addEventListener('change', () => {
            // Close other accordion items
            closeOtherAccordions(item);
          });
        });

        // Function to close other accordion items
        function closeOtherAccordions(currentItem) {
          accordionItems.forEach(item => {
            const toggle = item.querySelector('.accordion-toggle');

            if (item !== currentItem) {
              toggle.checked = false;
            }
          });
        }

        </script>




    </div>

