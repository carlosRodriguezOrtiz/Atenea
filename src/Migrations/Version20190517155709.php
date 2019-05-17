<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190517155709 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE questions_externes ADD corporacion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE questions_externes ADD CONSTRAINT FK_C3428BEC1011F129 FOREIGN KEY (corporacion_id) REFERENCES corporacion (id)');
        $this->addSql('CREATE INDEX IDX_C3428BEC1011F129 ON questions_externes (corporacion_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE questions_externes DROP FOREIGN KEY FK_C3428BEC1011F129');
        $this->addSql('DROP INDEX IDX_C3428BEC1011F129 ON questions_externes');
        $this->addSql('ALTER TABLE questions_externes DROP corporacion_id');
    }
}
