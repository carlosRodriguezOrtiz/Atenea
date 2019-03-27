<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190326190105 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE centro ADD empresas_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE centro ADD CONSTRAINT FK_2675036B602B00EE FOREIGN KEY (empresas_id) REFERENCES empresa (id)');
        $this->addSql('CREATE INDEX IDX_2675036B602B00EE ON centro (empresas_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE centro DROP FOREIGN KEY FK_2675036B602B00EE');
        $this->addSql('DROP INDEX IDX_2675036B602B00EE ON centro');
        $this->addSql('ALTER TABLE centro DROP empresas_id');
    }
}
