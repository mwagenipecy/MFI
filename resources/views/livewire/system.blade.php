<div>

    @switch($this->menu_id)
        @case('0')
            <livewire:dashboard.dashboard/>
            @break
        @case('1')
            <livewire:branches.branches />
            @break
        @case('2')
            <livewire:clients.clients />
            @break
        @case('3')
        <livewire:shares.shares />
          @break
          @case('4')
          <livewire:savings.savings />
            @break
          @case('5')
          <livewire:deposits.deposits />
          @break
         @case('6')
         <livewire:loans.loans />
          @break
          @case('7')
            <livewire:accounting.accounting />
            @break
          @case('8')
          <livewire:products-management.product-management />
            @break
          @case('9')
            <livewire:members.members />
            @break
          @case('11')
            <livewire:payments.payments />
            @break
            @case('10')
            <livewire:h-r.h-r />
            @break
            @case('14')
            <livewire:procurement.procurement />
            @break
            @case('12')
            <livewire:reconciliation.reconciliation />
            @break
            @case('13')
            <livewire:reports.reports />
            @break
            @case('49')
            <livewire:approvals.approvals-processor />
            @break
            @case('50')
            <livewire:settings.settings />
            @break

{{--            @case('17')--}}
{{--        <livewire:investment.investment />--}}
{{--             @break--}}

            @case('16')
            <div class="p-4">
                <livewire:expenses.expense />
{{--                <livewire:accounting.expenses-table />--}}
            </div>
             @break
           @case('18')
              <livewire:teller-management.teller/>

        @break

        @case('17')
        <livewire:budget-management.budget/>
        @break

           @case('19')
            <livewire:profile-setting.profile/>
            @break

        @default
            <livewire:dashboard.dashboard/>
    @endswitch
</div>

