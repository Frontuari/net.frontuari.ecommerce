<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(VoyagerDatabaseSeeder::class);
        $this->call(DataTypesTableSeeder::class);
        $this->call(DataRowsTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(MenuItemsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(PeoplesTableSeeder::class);
        $this->call(ViewsTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(CoinsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(LogsTableSeeder::class);
        $this->call(GeneralSettingsTableSeeder::class);
        $this->call(DetGroupEventsTableSeeder::class);
        $this->call(BanksTableSeeder::class);
        $this->call(PaymentMethodsTableSeeder::class);
        $this->call(BankDatasTableSeeder::class);
        $this->call(TransportsTableSeeder::class);
        $this->call(DetTransportCitiesTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(PackagesTableSeeder::class);
        $this->call(TaxesTableSeeder::class);
        $this->call(PackagingsTableSeeder::class);
        $this->call(HomePagesTableSeeder::class);
        $this->call(StoresTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(SubCategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(FavoritesTableSeeder::class);
        $this->call(OrderAddressTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(OrderProductsTableSeeder::class);
        $this->call(DetProductTaxesTableSeeder::class);
        $this->call(OrdersStatusTableSeeder::class);
        $this->call(TrackingsTableSeeder::class);
        $this->call(UserVisitProductsTableSeeder::class);
        $this->call(DetProductPackagesTableSeeder::class);
        $this->call(DetBankOrdersTableSeeder::class);
        $this->call(RatingProductsTableSeeder::class);
        $this->call(AdvsTableSeeder::class);
        $this->call(DetSubCategoriesTableSeeder::class);
        $this->call(CalendarsTableSeeder::class);
        $this->call(DetTaxTransportsTableSeeder::class);
        $this->call(PagesTableSeeder::class);
    }
}
