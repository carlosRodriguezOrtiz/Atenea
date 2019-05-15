<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190513185519 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE emergente (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE binomio (id INT AUTO_INCREMENT NOT NULL, question_interna_id INT DEFAULT NULL, question_externa_id INT DEFAULT NULL, selected TINYINT(1) NOT NULL, INDEX IDX_C2C4060DB6EB97F8 (question_interna_id), INDEX IDX_C2C4060D730D4C8D (question_externa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE binomio ADD CONSTRAINT FK_C2C4060DB6EB97F8 FOREIGN KEY (question_interna_id) REFERENCES questions_internes (id)');
        $this->addSql('ALTER TABLE binomio ADD CONSTRAINT FK_C2C4060D730D4C8D FOREIGN KEY (question_externa_id) REFERENCES questions_externes (id)');
        $this->addSql('ALTER TABLE user ADD corporacion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6491011F129 FOREIGN KEY (corporacion_id) REFERENCES corporacion (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6491011F129 ON user (corporacion_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE emergente');
        $this->addSql('DROP TABLE binomio');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6491011F129');
        $this->addSql('DROP INDEX IDX_8D93D6491011F129 ON user');
        $this->addSql('ALTER TABLE user DROP corporacion_id');
    }
}
