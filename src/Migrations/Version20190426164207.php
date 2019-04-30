<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190426164207 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE binomio (id INT AUTO_INCREMENT NOT NULL, question_interna_id INT DEFAULT NULL, question_externa_id INT DEFAULT NULL, selected TINYINT(1) NOT NULL, INDEX IDX_C2C4060DB6EB97F8 (question_interna_id), INDEX IDX_C2C4060D730D4C8D (question_externa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE binomio ADD CONSTRAINT FK_C2C4060DB6EB97F8 FOREIGN KEY (question_interna_id) REFERENCES questions_internes (id)');
        $this->addSql('ALTER TABLE binomio ADD CONSTRAINT FK_C2C4060D730D4C8D FOREIGN KEY (question_externa_id) REFERENCES questions_externes (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE binomio');
    }
}
