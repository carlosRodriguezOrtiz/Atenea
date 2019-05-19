<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190515170232 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE questions_externes DROP FOREIGN KEY FK_C3428BEC898C381B');
        $this->addSql('DROP INDEX IDX_C3428BEC898C381B ON questions_externes');
        $this->addSql('ALTER TABLE questions_externes CHANGE tipus_id subtipus_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE questions_externes ADD CONSTRAINT FK_C3428BEC821C8592 FOREIGN KEY (subtipus_id) REFERENCES sub_tipus_qe (id)');
        $this->addSql('CREATE INDEX IDX_C3428BEC821C8592 ON questions_externes (subtipus_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE questions_externes DROP FOREIGN KEY FK_C3428BEC821C8592');
        $this->addSql('DROP INDEX IDX_C3428BEC821C8592 ON questions_externes');
        $this->addSql('ALTER TABLE questions_externes CHANGE subtipus_id tipus_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE questions_externes ADD CONSTRAINT FK_C3428BEC898C381B FOREIGN KEY (tipus_id) REFERENCES tipus_qe (id)');
        $this->addSql('CREATE INDEX IDX_C3428BEC898C381B ON questions_externes (tipus_id)');
    }
}
