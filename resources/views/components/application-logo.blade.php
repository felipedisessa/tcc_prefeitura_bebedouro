<img src="{{ asset('images/logo-dark.png') }}" alt="Logo" class="logo img-fluid">


<style>
    /* CSS padrão (modo escuro) */
    .logo {
      content: url('{{ asset('images/logo.png') }}');
      width: 200px;
    }
  
    /* CSS para modo claro */
    @media (prefers-color-scheme: light) {
      .logo {
        content: url('{{ asset('images/logo-white.png') }}');
      }
    }
  </style>
  
