<?php

declare(strict_types=1);

namespace Tests\Unit;



class MailServiceTest extends TestCase
{
   
   /* protected function setUp(): void
    {
        $this->mailer = $this->createMock(MailerInterface::class);
        $this->translator = $this->createStub(TranslatorInterface::class);

        $this->service = new MailService(
            $this->mailer,
            $this->translator,
            'from@symfony.local',
            ['bcc@symfony.local']
        );
    }*/

    /**
     * @test
     */
   /* public function itSendsAnEmail(): void
    {
        $this->translator->method('trans')->willReturnMap([
            ['email.from_name', [], null, 'en', 'From Name'],
            ['subject', [], null, 'en', 'Subject'],
        ]);
        $this->mailer->expects(static::once())->method('send')->with(static::isInstanceOf(TemplatedEmail::class));

        $this->service->setLocale('en');
        $this->service->send('to@symfony.local', 'subject', 'template');
    }*/
}
