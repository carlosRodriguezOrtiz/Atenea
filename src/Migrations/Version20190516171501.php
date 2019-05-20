<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190516171501 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE aspecte_q (id INT AUTO_INCREMENT NOT NULL, questions_externes_id INT DEFAULT NULL, questions_internes_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, dafo VARCHAR(255) NOT NULL, alta DATETIME NOT NULL, baixa DATETIME NOT NULL, descripcio VARCHAR(255) NOT NULL, INDEX IDX_556D6A54861C8D0B (questions_externes_id), INDEX IDX_556D6A54A6B6EE63 (questions_internes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE aspecte_q ADD CONSTRAINT FK_556D6A54861C8D0B FOREIGN KEY (questions_externes_id) REFERENCES questions_externes (id)');
        $this->addSql('ALTER TABLE aspecte_q ADD CONSTRAINT FK_556D6A54A6B6EE63 FOREIGN KEY (questions_internes_id) REFERENCES questions_internes (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE aspecte_q');
    }
}
