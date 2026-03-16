<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260316003238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE keyword (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE keyword_bookmark (keyword_id INT NOT NULL, bookmark_id INT NOT NULL, INDEX IDX_4B095F4C115D4552 (keyword_id), INDEX IDX_4B095F4C92741D25 (bookmark_id), PRIMARY KEY (keyword_id, bookmark_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE keyword_bookmark ADD CONSTRAINT FK_4B095F4C115D4552 FOREIGN KEY (keyword_id) REFERENCES keyword (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE keyword_bookmark ADD CONSTRAINT FK_4B095F4C92741D25 FOREIGN KEY (bookmark_id) REFERENCES bookmark (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE keyword_bookmark DROP FOREIGN KEY FK_4B095F4C115D4552');
        $this->addSql('ALTER TABLE keyword_bookmark DROP FOREIGN KEY FK_4B095F4C92741D25');
        $this->addSql('DROP TABLE keyword');
        $this->addSql('DROP TABLE keyword_bookmark');
    }
}
