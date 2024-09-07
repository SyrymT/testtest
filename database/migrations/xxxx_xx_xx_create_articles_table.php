use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('doi')->nullable()->unique();
            $table->text('abstract');
            $table->text('keywords');
            $table->text('full_text');
            $table->string('pdf_path');
            $table->enum('status', ['draft', 'submitted', 'under_review', 'accepted', 'rejected', 'published']);
            $table->foreignId('issue_id')->nullable()->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
}