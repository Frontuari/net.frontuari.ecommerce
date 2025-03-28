<?php
    namespace App\Mail;

    use Illuminate\Bus\Queueable;
    use Illuminate\Mail\Mailable;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Contracts\Queue\ShouldQueue;

    class UsuarioRegistro extends Mailable {

        use Queueable, SerializesModels;
        public $link;
        /**
         * Create a new message instance.
         *
         * @return void
         */
        public function __construct($link)
        {
            $this->link = $link;
        }

        /**
         * Build the message.
         *
         * @return $this
         */
        public function build()
        {
            return $this->markdown('email.verification')->subject('Bienvenido a EOS!');
        }
    }
