<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260318002855 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE author DROP FOREIGN KEY `FK_BDAFD8C871179CD6`');
        $this->addSql('DROP INDEX IDX_BDAFD8C871179CD6 ON author');
        $this->addSql('ALTER TABLE author ADD name VARCHAR(255) NOT NULL, DROP name_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE author ADD name_id INT NOT NULL, DROP name');
        $this->addSql('ALTER TABLE author ADD CONSTRAINT `FK_BDAFD8C871179CD6` FOREIGN KEY (name_id) REFERENCES book (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_BDAFD8C871179CD6 ON author (name_id)');
    }
}
