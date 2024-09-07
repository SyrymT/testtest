public function up()
{
    Schema::create('issues', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->date('publication_date');
        $table->string('cover_image_path')->nullable();
        $table->string('pdf_path')->nullable();
        $table->timestamps();
    });
}