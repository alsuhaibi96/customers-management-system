    <?php

    use App\Models\Order;
    use App\Models\Product;
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('order_product', function (Blueprint $table) {
                $table->id();
                $table->foreignIdFor(Order::class);
                $table->foreignIdFor(Product::class);
                $table->integer('quantity')->default(0);
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::table('order_product', function (Blueprint $table) {
                // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            });
            Schema::dropIfExists('order_product');
        }
    };
